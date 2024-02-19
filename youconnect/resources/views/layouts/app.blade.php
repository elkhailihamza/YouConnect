<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-30 bg-[#F0F2F5] dark:bg-[#18191A]" style="height: 100vh;">
    @include('layouts.nav')
    @include('layouts.bars')
    <div class="container-xl flex justify-center">
        @yield('content')
    </div>
    @vite('resources/js/app.js')
    @vite('resources/js/like.js')
    @vite('resources/js/ThemeChange.js')
</body>
<script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>

</html>