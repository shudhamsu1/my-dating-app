<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Geocoder\Geocoder;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    public function showCorrectHomepage()
    {
        return view('homepage');
    }

    public function login(Request $request)
    {

        $incomingfields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $incomingfields['email'], 'password' => $incomingfields['password']])) {
            $user = Auth::user();
            if (!$user->verified) {
                Auth::logout();
                return back()->with('failure', 'Your account has not been verified yet. Please check your email.');
            }
            else{
                $request->session()->regenerate();
                return redirect('/homepagefeed')->with('success', 'You have successfully logged in.');

            }

        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }



   /* public function login(Request $request)
    {

        $incomingfields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $incomingfields['email'], 'password' => $incomingfields['password']])) {
            $request->session()->regenerate();
            return redirect('/homepagefeed')->with('success', 'You have successfully logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }*/

    public function register(Request $request)
    {

        $incomingFields = $request->validate([
            'first_name' => ['required', 'min:3', 'max:13'],
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7'],
            'gender' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required'

        ]);
        $client = new Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey('AIzaSyDsDbf6HI9VCkiCZaR3udlrz8lslseyC5o');
        $result = $geocoder->getCoordinatesForAddress($incomingFields['address']);

        if ($result) {
            $latitude = $result['lat'];
            $longitude = $result['lng'];
            $incomingFields['latitude'] = $latitude;
            $incomingFields['longitude'] = $longitude;
        } else {
            return redirect()->back()->withErrors(['address' => 'Invalid address']);
        }

        $incomingFields['password'] = password_hash($incomingFields['password'], PASSWORD_BCRYPT);
        $user = User::create($incomingFields);


        if ($incomingFields['date_of_birth'] < 18){
            return redirect('/')->with('failure', 'Sorry you need to be atleast 18');
        } else{
            $user->generateVerificationToken();
            Mail::to($user->email)->send(new VerifyEmail($user));
            return redirect('/')->with('success', 'Thank you for creating an account. Please verify with the link sent to your email');

        }
            }

    /*public function login(Request $request){

        $incomingFields=$request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if (auth()->attempt($incomingFields)) {
            $request->session()->regenerate();
            return redirect('/homepagefeed')->with('success','you have sucessfully loged in');
        }else{
            return redirect('/')->with('success','login failed, no such user in the database');
        }
    }*/
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You are now logged out.');

    }
    public function search(Request $request)
    {

        $query = User::query();

        // Filter by username
        if ($request->has('username')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->input('username') . '%')
                  ->orWhere('last_name', 'like', '%' . $request->input('username') . '%');
            });
        }


        // Filter by gender
        if ($request->has('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }
        // Filter by age
        if ($request->has('age')) {
            $age = $request->input('age');
            if ($age !== 'all' && $age !== 'custom') {
                $ageRange = explode('-', $age);
                $minAge = $ageRange[0];
                $maxAge = $ageRange[1];
                $query->whereBetween('date_of_birth', [
                    Carbon::now()->subYears($maxAge)->format('Y-m-d'),
                    Carbon::now()->subYears($minAge)->format('Y-m-d'),
                ]);
            } elseif ($age === 'custom' && $request->has('age-custom')) {
                $ageRange = explode('-', $request->input('age-custom'));
                $minAge = $ageRange[0];
                $maxAge = $ageRange[1];
                $query->whereBetween('date_of_birth', [
                    Carbon::now()->subYears($maxAge)->format('Y-m-d'),
                    Carbon::now()->subYears($minAge)->format('Y-m-d'),
                ]);
            }
        }

        // Filter by distance
        if ($request->has('distance')) {
            $distance = $request->input('distance');
            if ($distance !== '' && $distance !== '0') {
                $latitude = auth()->user()->latitude;
                $longitude = auth()->user()->longitude;
                $earthRadius = 6371; // km

                // Formula for calculating distance between two latitudes and longitudes
                $haversine = "(6371 * acos(cos(radians($latitude))
                    * cos(radians(latitude))
                    * cos(radians(longitude)
                    - radians($longitude))
                    + sin(radians($latitude))
                    * sin(radians(latitude))))";

                // Add a select distance clause to the query
                $query->selectRaw("{$haversine} AS distance");

                // Add a where clause to filter by distance
                $query->whereRaw("{$haversine} < ?", [$distance]);
            }
        }

        $users = $query->select('*')->paginate(4);

        return view('HomeFeedPage.search', ['users' => $users]);

    }


    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = true;
        $user->verification_token = null;
        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('success', 'Your account has been verified. You can now log in.');
    }
}
