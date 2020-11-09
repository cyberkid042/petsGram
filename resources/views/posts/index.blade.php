@extends('layouts.app')

@section('title')
NewsFeed
@endsection


@section('content')
<div class="d-flex justify-content-center">
    @if(session()->has('verified'))
    <div class="alert alert-success">
        <p>Your Email has been successfully verified.Thank you!</p>
    </div>
    @endif
</div>
<div class="container pt-5">
    @forelse ($posts as $post)

    <div class="container pt-3">

        <div class="col-lg-7 offset-2 mx-auto">
            <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" class="w-100 rounded"></a>
        </div>


        <div class="col-lg-7 offset-2 mx-auto pt-2">
            <div>
                <span class="pr-2 font-weight-bold"><a class="text-dark"
                        href="/profile/{{$post->user->username}}">{{$post->user->username}}</a></span>{{$post->caption}}
            </div>
            <div style="color: grey">posted
                {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
        </div>
        <hr>
    </div>

    @empty
    <div class="container d-flex justify-content-between">
        <p></p>
        <div class="mt-5">
            <p><strong>Only Posts from People you follow, will be displayed here. Start following other users!</strong>
            </p>
        </div>
        <p></p>
    </div>
    @endforelse

    <div class="row">
        <div class="col-12 d-flex justify-content-center pb-5 pt-3">
            {{$posts->links()}}
        </div>
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