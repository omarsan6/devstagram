<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post){
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post){
        /**
         * Request accede al modelo usuario y su metodo likes, donde el post_id
         * sea el mismo que se está tocando y se elimina 
         */
        $request->user()->likes()->where('post_id',$post->id)->delete();
        return back();
    }
}
