@extends('layouts.app')

@section('titulo')
    Iniciar sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-5 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/login.jpg')}}" alt="login">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
            <form action="{{route('login')}}" method="POST">
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>

                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        placeholder="Email"
                        class="border p-3 w-full rounded-lg
                        @error('email')
                            border-red-500
                        @enderror"
                        value="{{old('email')}}"
                    >
                
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>

                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        placeholder="Contraseña"
                        class="border p-3 w-full rounded-lg
                        @error('name')
                        border-red-500
                        @enderror"    
                    >
                
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember"> 
                    <label for="" class="text-gray-500 text-sm">Mantener sesión abierta</label>
                </div>
                
                <input 
                    type="submit"
                    value="Iniciar sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full text-white p-3">
            </form>
        </div>

    </div>
@endsection