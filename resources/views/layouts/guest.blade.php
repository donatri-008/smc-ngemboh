<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Smart Maritim Community Ngemboh')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/utama/Logo SMC.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#F6F9FF] min-h-screen">
    @yield('content')
</body>
</html>