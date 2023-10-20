<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    
    public $isLike;

    public $likes;

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like(){
        if($this->post->checkLike(auth()->user())){
            //eliminar un me gusta
            $this->post->likes()->where('post_id',$this->post->id)->delete();
            $this->isLike = false;
            $this->likes--;
        } else {
            //agregar un me gusta
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLike = true;
            $this->likes++;
        }
    }

    //es como constructor de php
    public function mount($post){
        //revisa si el usuario ya le dió me gusta
        $this->isLike = $post->checkLike(auth()->user());

        $this->likes = $post->likes->count();
    }
}
