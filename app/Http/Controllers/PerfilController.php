<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //modificar un request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users', 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if ($request->imagen) {
            //almacenar el archivo recbido
            $imagen = $request->file('imagen');

            //crear un nombre unico a la imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            //crear la imagen con intervention image
            $imagenServidor = Image::make($imagen);

            //ajustar el tamaño
            $imagenServidor->fit(900, 900);

            //nombre de la ruta
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            //guardar la imagen
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();


        //redireccionar usuario
        return redirect()->route('post.index',$usuario->username);
    }
}
