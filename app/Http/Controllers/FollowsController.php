<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    //

    public function _construct(){
        $this->middleware('auth');
    }

    public function store(User $user){
        // $this->authorize('update', $user->profile);
        return auth()->user()->following()->toggle($user->profile);
    }
}
