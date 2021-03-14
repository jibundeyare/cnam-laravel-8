<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello @yield('title')</title>
    @section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @show
</head>
<body>
    <header class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                logo
            </div>
            <div class="col-6 col-md-3 order-md-3">
                icônes
            </div>
            <div class="col-12 col-md-6 order-md-2">
                barre de recherche
            </div>
        </div>

        <nav>
            menu
        </nav>
    </header>

    @section('content')
        <div class="container">
            <h1>Hello @yield('title')</h1>
        </div>
    @show

    <footer class="container">
        <div class="row">
            <div class="col-12 d-md-none">
                réseaux sociaux
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                valeurs
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-2">
                <ul>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-2">
                <ul>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-2">
                <ul>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-2">
                <ul>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                    <li><a href="/">footer</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4 d-none d-md-block">
                réseaux sociaux
            </div>
        </div>
    </footer>

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @show
</body>
</html>