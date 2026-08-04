<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neu min-h-screen flex items-center justify-center px-6">
    <x-ui.card padding="p-10" class="max-w-md text-center space-y-6">
        <div class="w-20 h-20 rounded-full bg-neu shadow-neu-in flex items-center justify-center mx-auto">
            <x-heroicon-o-map class="w-10 h-10 text-indigo-500" />
        </div>
        <div>
            <p class="text-5xl font-bold text-gray-700">404</p>
            <p class="text-gray-500 mt-2">Halaman yang kamu cari tidak ditemukan. Mungkin sudah dipindahkan atau memang belum ada.</p>
        </div>
        <x-ui.button href="{{ route('home') }}">Kembali ke Beranda</x-ui.button>
    </x-ui.card>
</body>
</html>