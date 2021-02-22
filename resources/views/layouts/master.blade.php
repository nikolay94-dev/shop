<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
@yield('style')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            margin-top: 20px;
        }

        .title {
            font-size: 25px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .header {
            margin-top: 20px;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="links">
        <a href="{{ route('main') }}">Главная страница</a>
        <a href="{{ route('category.index') }}">Категории товаров</a>
        <a href="{{ route('product.index') }}">Товары</a>
    </div>
</div>
<div class="position-ref full-height">
@yield('content')
</div>
</body>
</html>
