<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    public function createFollow(User $user){
        //you cannot follow yourself
        //if the user_id equals to your id then
        if($user->id == auth()->user()->id){
            return back()->with('failure', 'You cannot follow yourself');
        }

        //you cannot follow someone you're already following
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id],['followinguser', '=', $user->id]])->count();
        //if the user logged in is loggin in with your user_id and if we find the line above we get the count 1

        if($existCheck){
            return back()->with('failure', 'You are already following');
        }


        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followinguser = $user->id;
        $newFollow->save();

        return back()->with('success', 'user successfully followed');
    }

    public function  removeFollow(User $user){
        Follow::where([['user_id', '=', auth()->user()->id], ['followinguser', '=', $user->id]])->delete();
        return back()->with('success', "user successfully unfollowed");
    }
}
