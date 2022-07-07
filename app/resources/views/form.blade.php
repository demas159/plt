<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHP LARAVEL TEST</title>

    </head>
    <body class="antialiased">

    <form action="/queueUrl" method="POST">
        @csrf
        <input name="url" type="text" placeholder="Input url to download">
        <input type="submit" value="Set to Queue Download">
    </form>
    {{$error}}
    </body>
</html>
