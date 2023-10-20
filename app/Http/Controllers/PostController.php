<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user){

        //paginar los posts
        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);

        //pasar datos a la vista
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //crear el formulario
    public function create(){
        return view('posts.create');
    }

    //almacena en la base de datos
    public function store(Request $request){
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index',auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show',[
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){

        //verifica si la persona que quiere eliminar es la misma del perfil de usuario
        $this->authorize('delete',$post);

        //eliminando de la base de datos
        $post->delete();

        //eliminar la imagen /uploads
        $imagen_path = public_path('uploads/'.$post->imagen);

        //pregunta si la imagen existe
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }


        return redirect()->route('post.index',auth()->user()->username);
    }
}
