@extends('layouts.app')

@section('title')
{{$user->username}}'s Profile
@endsection

@section('content')
<div class="d-flex justify-content-center">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 pr-5 pl-5 pt-5">
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle profilephoto">
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <h2 class="pr-3">{{$user->username}}</h2>

                    @can('follow', $user->profile)
                    <follow-button user-id="{{$user->username}}" follows="{{$follows}}"
                        onClick="window.location.reload();"></follow-button>
                    @endcan

                </div>
                @can('update', $user->profile)
                <a class="btn btn-primary" href="/p/create">Add Post</a>
                @endcan
            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>{{$postCount}}</strong> posts</div>
                <div class="pr-4"><strong>{{$followersCount}}</strong> followers</div>
                <div><strong>{{$followingCount}}</strong> following</div>
            </div>
            <div class="pt-3">


                @can('update', $user->profile)
                <div class="align-items-baseline pb-2">
                    <a class="btn btn-warning" href="/profile/{{$user->username}}/edit">Edit Profile</a>
                </div>
                @endcan


                <strong class="pr-4">{{$user->profile->title}}</strong>
            </div>
            <div>
                {{$user->profile->description}}
            </div>
            <div>
                <a href="{{$user->profile->url}}" style="color: #45046a; font-weight: bold"
                    target="_blank">{{$user->profile->url}}</a>
            </div>
            <hr>
        </div>
    </div>

    <div class="row pt-4 profile-bottom">
        @forelse ($user->posts as $post)
        <div class="col-lg-4 pb-3 d-flex justify-content-between">
            <p></p>
            <div>
                <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" class="rounded"></a>
                <hr>
            </div>
            <p></p>
        </div>


        @empty

        <div class="container d-flex justify-content-between">
            <p></p>
            <div>
                <p><strong>There are no posts yet. Click on Add Post to start posting!</strong></p>
            </div>
            <p></p>
        </div>
        @endforelse

    </div>
</div>
@endsection

@section('script')
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 4000);
    
</script>
@endsection