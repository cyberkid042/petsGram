<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    //
    public function __construct() {
        $this->middleware(['auth','verified']);
    }

    public function index(){

        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){

         $request->validate([
         'caption' => 'required',
         'image' => 'required|image|max:2048',
         ]);

         $imagepath = request('image')->store('uploads', 'public');

         $image = Image::make(public_path("storage/{$imagepath}"))->fit(350,350);
         $image->save();

         auth()->user()->posts()->create([
             'caption' => $request['caption'],
             'image' => $imagepath,
         ]);

        //  $post = new Post;


        return redirect('profile/'.auth()->user()->username)->with('message', 'post created successfully');
    }

    public function show(Post $post){

       

        return view('posts.show', compact('post'));
    }
}
