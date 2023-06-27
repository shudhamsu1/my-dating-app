<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Follow;
use Spatie\Geocoder\Geocoder;

class ProfileController extends Controller
{
    public function homefeed()
    {
        $user=Auth::user();
        $cards= User::inRandomOrder()->paginate(8);

        return view('HomeFeedPage.card',[ 'followings' => $user->userFollowing()->latest()->get(),'user' => $user,'cards'=>$cards]);
    }


    public function index(User $user){
        $currentlyFollowing = 0;
        $currentFollowers = 0;

//        does the current logged-in user have a follow that matched the $user above
        if (auth()->check()){
//            return $user->userFollowing()->latest()->get();
            $currentlyFollowing= Follow::where([['user_id', '=', auth()->user()->id],['followinguser', '=', $user->id]])->count();
            $currentFollowers = Follow::where([['user_id', '=', $user->id], ['followinguser', '=', auth()->user()->id]])->count();

        }

        return view('Profiles.post',[ 'followings' => $user->userFollowing()->latest()->get(),'currentlyFollowing' => $currentlyFollowing,'currentFollowers'=>$currentFollowers,'firstName'=> $user->first_name, 'lastName' => $user->last_name,'user'=>$user]);

}
public function edit(User $user){
        return view('Profiles.edit',compact('user'));

}
public function update(User $user){
        $data = request()->validate([
                'first_name'=>'required',
                'last_name' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'address' => 'required',
                'bio'=>'required'
        ]);
    $client = new Client();
    $geocoder = new Geocoder($client);
    $geocoder->setApiKey('AIzaSyDsDbf6HI9VCkiCZaR3udlrz8lslseyC5o');
    $result = $geocoder->getCoordinatesForAddress($data['address']);

    if ($result) {
        $latitude = $result['lat'];
        $longitude = $result['lng'];
        $data['latitude'] = $latitude;
        $data['longitude'] = $longitude;
    } else {
        return redirect()->back()->withErrors(['address' => 'Invalid address']);
    }

    auth()->user()->update($data);

        return redirect("/profile/{$user->id}");




}
public function store(){
    $data= request()->validate([
        'profile_picture'=>['required','image'],
    ]);
    $imagePath = request('profile_picture')->store('profile', 'public');
    $image=Image::make(public_path("storage/{$imagePath}"))->fit(450,450);
    $image->save();

    $user=Auth::user();
    $user->profile_picture= $imagePath;
    $user->save();
    return redirect('/profile/'.$user->id)->with('success','You have successfully changed your avatar');



}

    public function profileFollower(User $user){
        $currentlyFollowing = 0;
        $currentFollowers = 0;

//        does the current logged-in user have a follow that matched the $user above
        if (auth()->check()){
//            return $user->followers()->latest()->get();
            $currentlyFollowing= Follow::where([['user_id', '=', auth()->user()->id],['followinguser', '=', $user->id]])->count();
            $currentFollowers = Follow::where([['user_id', '=', $user->id], ['followinguser', '=', auth()->user()->id]])->count();
        }

        return view('Profiles.profile-followers',['currentlyFollowing' => $currentlyFollowing,'currentFollowers'=>$currentFollowers,'firstName'=> $user->first_name, 'lastName' => $user->last_name,'user'=>$user,'followers' =>$user->followers()->latest()->get()]);
    }
    public function profileFollowing(User $user){
        $currentlyFollowing = 0;
        $currentFollowers = 0;

//        does the current logged in user have a follow that matched the $user above
        if (auth()->check()){
//            return $user->userFollowing()->latest()->get();
            $currentlyFollowing= Follow::where([['user_id', '=', auth()->user()->id],['followinguser', '=', $user->id]])->count();
            $currentFollowers = Follow::where([['user_id', '=', $user->id], ['followinguser', '=', auth()->user()->id]])->count();
        }

        return view('Profiles.profile-following',[ 'followings' => $user->userFollowing()->latest()->get(),'currentFollowers'=>$currentFollowers,'currentlyFollowing' => $currentlyFollowing,'firstName'=> $user->first_name, 'lastName' => $user->last_name, 'user' => $user]);
    }

}
