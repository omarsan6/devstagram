@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    
    {{-- Componente de laravel --}}
    <x-listar-post :posts="$posts"  />
        
    
@endsection