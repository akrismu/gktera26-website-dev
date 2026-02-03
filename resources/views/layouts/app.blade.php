<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKJTU</title>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/layout/NavigationBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout/Footer.css') }}">

    @stack('styles')
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body>
    
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>