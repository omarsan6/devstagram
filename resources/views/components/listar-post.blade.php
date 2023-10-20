<div>
    @if ($posts->count())
    
        <div class="mx-10 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="">
                    <a href="{{route('posts.show',['post' => $post, 'user' => $post->user])}}">
                        <img src="{{asset('uploads') . '/'. $post->imagen}}" alt="{{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="m-10">
            {{$posts->links('')}}
        </div>

    @else
        <p class="text-center">No hay publicaciones, sigue a alguien.</p>
    @endif
</div>