<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title>@yield('title', config('app.name'))</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px"
          rel="stylesheet">

    @stack('head')

</head>
<body>

@yield('content')

@stack('body')
</body>
</html>



