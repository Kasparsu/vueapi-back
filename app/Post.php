<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public $fillable = [
      'title',
      'content',
    ];
    protected $appends = [
        'is_liked',
        'is_disliked',
        'score',
        'likes_count',
        'dislikes_count',
        'comments_count',
        'reaction_value',
        'reaction_count'
    ];
    protected $with = ['images'];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function reactions(){
        return $this->hasMany(Reactions::class);
    }
    public function getIsLikedAttribute()
    {
        $user = Auth::user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->where('value', 1)->exists();
        }
        return false;
    }
    public function getIsDislikedAttribute()
    {
        $user = Auth::user();
        if($user){
            return $this->likes()->where('user_id', $user->id)->where('value', -1)->exists();
        }
        return false;
    }
    public function getScoreAttribute()
    {
        return (int) $this->likes()->select('value')->sum('value');
    }
    public function getLikesCountAttribute()
    {
        return $this->likes()->where('value', 1)->count();
    }
    public function getDislikesCountAttribute()
    {
        return $this->likes()->where('value', -1)->count();
    }
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
    public function getReactionValueAttribute()
    {
        $user = Auth::user();
        if($user){
            $reactarray = $this->reactions()->where('user_id', $user->id)->get();
            if(!empty($reactarray[0]))
            {
                return $reactarray[0]->reaction_value;
            }
        }
        return false;
    }
    public function getReactionCountAttribute()
    {
        $reactarray = $this->reactions()->get();
        $returnarray=[0,0,0,0];
        if(!empty($reactarray))
        {
            foreach($reactarray as $react){
                $singleCount = $react->reaction_value;
                if($singleCount==1) { $returnarray[0] += 1; }
                if($singleCount==2) { $returnarray[1] += 1; }
                if($singleCount==3) { $returnarray[2] += 1; }
                if($singleCount==4) { $returnarray[3] += 1; }
            }
            return $returnarray;
        }
        return false;
    }
}
