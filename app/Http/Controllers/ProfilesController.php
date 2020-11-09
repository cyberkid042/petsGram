<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use App\User;
use Auth;

class ProfilesController extends Controller
{
    //

    public function index(User $user){

        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false;

        // $postCount= Cache::remember('counts.posts', $user->id, function () use ($user) {
        //     return $user->posts->count();
        // });

        $postCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        // $followersCount = Cache::remember('counts.followers', $user->id, function () use ($user)
        // {
        //     return $user->profile->followers->count();
        // });

        // $followingCount = Cache::remember('counts.following', $user->id, function () use ($user)
        // {
        //     return $user->following->count();
        // });

       return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    //
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Profile $profile
    * @return \Illuminate\Http\Response
    */
    public function show(Profile $profile)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Profile $profile
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
    //
        return view('profiles.edit',compact('user'));
    
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Profile $profile
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user->profile);
    //
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',


        ]);

        if(request('image')){
            $imagepath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagepath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect('/profile/'.auth()->user()->username)->with('message','Profile updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param \App\Profile $profile
    * @return \Illuminate\Http\Response
    */
    public function destroy(Profile $profile)
    {
    //
    }
}
