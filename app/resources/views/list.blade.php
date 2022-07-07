<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP LARAVEL TEST</title>

</head>
<body class="antialiased">

<ul>
@foreach($urls as $url)
    <li> {{$url->url }} - {{$url->status}} @if($url->status == \App\Models\UrlDownloader::STATUS_COMPLETE) <a href='/download/{{$url->id}}'>Download</a> @endif</li>
@endforeach
</ul>
</body>
</html>
