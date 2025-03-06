<x-app-layout>
    <div class="p-4 container mx-auto">


        <h1 class="text-3xl">Tablón de anuncios</h1>

        <p class="my-4">
            <a href="/message">Crear un mensaje</a>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($messages as $message)
                <article class="py-4 px-6 bg-white mb-4">
                    <h2 class="text-xl mb-2">{{$message->title}}</h2>
                    <div>{{$message->content}}</div>
                    @if($message->url)
                        <p>
                            <a href="{{$message->url}}">Más información</a>
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>

</x-app-layout>
