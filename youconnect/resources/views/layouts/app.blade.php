<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-30 bg-[#F0F2F5] dark:bg-[#18191A]" style="height: 100vh;">
    @include('layouts.nav')
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1 1 0 0 1-1.415 1.414l-2.829-2.828-2.828 2.828a1 1 0 1 1-1.414-1.414l2.828-2.829-2.828-2.828a1 1 0 0 1 1.414-1.414l2.828 2.828 2.829-2.828a1 1 0 0 1 1.415 1.414l-2.828 2.828 2.828 2.829z"/></svg>
        </span>
    </div>
@endif
    @include('layouts.bars')
    <div class="container-xl flex justify-center">
        @yield('content')
    </div>
    @vite('resources/js/app.js')
    @vite('resources/js/comment.js')
    @vite('resources/js/ThemeChange.js')
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</html>