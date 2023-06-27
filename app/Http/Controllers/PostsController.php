<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function create(){
        return view('Posts.create');

    }
    public function store(){
        $data= request()->validate([
            'caption'=>'required',
            'image'=>['required','image'],
        ]);
        $imagePath = request('image')->store('uploads', 'public');
        $image=Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,

        ]);
        return redirect('/profile/'.auth()->user()->id);
    }
}
