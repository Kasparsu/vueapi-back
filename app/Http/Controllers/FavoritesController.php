<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{

    public function removePostFromFavorites($id){
        return $this->removePost($id);
    }


    private function removePost($id){
        $user = Auth::user();
        $post = Post::where('id', $id)->with('images')->first();
        $favorite = $post->favorites()->where('user_id', $user->id)->first();
        $favorite->delete();
        return $post;
    }

    public function savePostToFavorites($id){
        return $this->savePost($id);
    }

    private function savePost($id){
        $user = Auth::user();
        $post = Post::where('id', $id)->with('images')->first();
        $favorite = new Favorite();
        $favorite->post()->associate($post);
        $favorite->user()->associate($user);
        $favorite->save();
        return $post;
    }


}
