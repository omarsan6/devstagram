<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected  $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        //pocisionarse en la tabla de likes, pregunta si en la columna user_id existe el usuario con su id
        return $this->likes->contains('user_id',$user->id);
    }
}
