<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = [
        'content'
    ];
    protected $appends = [
        'is_liked',
        'likes_count'
    ];
    protected $with = ['user'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function likes(){
        return $this->hasMany(CommentLike::class);
    }
    public function getIsLikedAttribute()
    {
        $user = Auth::user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->exists();
        }
        return false;
    }
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
