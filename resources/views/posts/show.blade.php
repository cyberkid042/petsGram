@extends('layouts.app')

@section('title')
Details
@endsection


@section('content')
<div>
    <div class="row justify-content-center p-5">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="/storage/{{$post->image}}" class="w-100 rounded">
        </div>

        <div class="col-lg-4 col-md-4">
            <div>
                <div class="d-flex align-items-center pt-2">
                    <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle detailsphoto">
                    <div class="pl-3 pr-3 font-weight-bold"><a class="text-dark"
                            href="/profile/{{$post->user->username}}">{{$post->user->username}}</a></div>
                    @can('follow', $post->user->profile)
                    <div class="pr-3">•</div>
                    <a href="/profile/{{$post->user->username}}">Follow</a>
                    @endcan
                </div>
                <hr class="pb-2">
                <div><span class="pr-2 font-weight-bold"><a class="text-dark"
                            href="/profile/{{$post->user->username}}">{{$post->user->username}}</a></span>{{$post->caption}}
                </div>
                <small style="color: grey">posted
                    {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
            </div>
        </div>


    </div>
</div>
@endsection