<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Mail\NewUserWelcomeMail;
use Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'image',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){ //Helps get rid of title issue if no profile is found
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username,

            ]);

            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function posts(){
    return $this->hasMany(Post::class)->latest();
    }

    public function following(){
        return $this->belongsToMany(Profile::class);
    }

    public function getRouteKeyName()
    {
    return 'username';
    }
   
}
