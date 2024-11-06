{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include ApexCharts from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Content/css/app.css') }}">
    <title>@yield('title', config('MyStocks', 'MyStocks'))</title>
    <link rel="icon" href="{{ asset('images/Cropped_Logo.png') }}" type="image/png">
    @livewireStyles
</head>
<style>
</style>

<body>
    @include('navbar', ['appName' => 'Hugo Montreuil'])
    <div class="container my-4">
        @yield('content') {{-- Where specific page content will be injected --}}
    </div>
    @livewireScripts
    @include('footer', ['appName' => 'Hugo Montreuil'])
</body>

</html>