<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>Tablón de anuncios</h1>
    @foreach ($messages as $message)
        <article>
            <h2>{{$message->title}}</h2>
            <div>{{$message->content}}</div>
            @if($message->url)
                <p>
                    <a href="{{$message->url}}">Más información</a>
                </p>
            @endif
        </article>
    @endforeach
</body>
</html>
