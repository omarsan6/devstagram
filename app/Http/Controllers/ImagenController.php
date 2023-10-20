<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {

        //almacenar el archivo recbido
        $imagen = $request->file('file');

        //crear un nombre unico a la imagen
        $nombreImagen = Str::uuid().".".$imagen->extension();

        //crear la imagen con intervention image
        $imagenServidor = Image::make($imagen);

        //ajustar el tamaño
        $imagenServidor->fit(900,900);

        //nombre de la ruta
        $imagenPath = public_path('uploads').'/'.$nombreImagen;

        //guardar la imagen
        $imagenServidor->save($imagenPath);

        //retornar un json con el nombre de la imagen
        return response()->json(['imagen' => $nombreImagen]);
    }
}
