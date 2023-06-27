<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessagesController extends Controller
{
    public function inbox(){
        $messages = auth()->user()->receivedMessages()
            ->with('sender')

            ->latest()->get();

        return view('Message.message-inbox', compact('messages'));

    }

    public function show(User $user){
        $messages = Message::where(function($query) use ($user){
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user){
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
        })->with('sender')->with('receiver')
            ->orderBy('created_at', 'desc')
            ->get();
      //  dd($messages);
        return view('Message.message-show', compact('user', 'messages'));
    }

    public function store(User $user,Request $request)
    {

        $data = $request->validate([
            'message' => 'required'
        ]);


        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
            'message' => $data['message']
        ]);

        return redirect()->back();
    }

//    public function createMessage(){
//        return view('create-message');
//    }

    public function message(User $user){

        return view('Message.message-profile',['user' => $user]);
    }

}
