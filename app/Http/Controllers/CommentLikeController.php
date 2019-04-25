<?php

namespace App\Http\Controllers;

use App\CommentLike;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function unlikeComment($id){
        return $this->removeLike($id);
    }

    private function removeLike($id){
        $user = Auth::user();
        $comment = Comment::where('id', $id)->first();
        $like = $comment->likes()->where('user_id', $user->id)->first();
        $like->delete();
        return $comment;
    }

    public function likeComment($id){
        return $this->saveLike($id);
    }

    private function saveLike($id){
        $user = Auth::user();
        $comment = Comment::where('id', $id)->first();
        if($user && $comment){
            $like = $user->commentLikes()->where('comment_id', $id)->first();
            if (!$like) {
                $like = new CommentLike();
                $like->comment()->associate($comment);
                $like->user()->associate($user);
                $like->save();
            }
        }
        return $comment;
    }
}
