<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    //
    protected $fillable = ['title', 'description', 'url', 'image'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function profileImage(){
        $imagePath = ($this->image) ? $this->image : 'profile/3YWeyxHQ1TsAjEh3mAFWdwFnTK21r3qvS1RGdTN3.png';
        return '/storage/'. $imagePath;
    }

}
