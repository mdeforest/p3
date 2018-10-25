<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/master.css">

    <title>@yield('title', config('app.name'))</title>

    @stack('head')

</head>
<body>

@yield('content')

@stack('body')
</body>
</html>



