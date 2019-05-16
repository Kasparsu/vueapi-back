<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    protected $fillable = [
        'reaction_value'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
