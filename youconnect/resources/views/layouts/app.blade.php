<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>

<body class="bg-blue-30 dark:bg-gray-900" style="height: 100vh;">
    @include('layouts.nav')
    @include('layouts.bars')
    <div class="container-xl flex justify-center">
        @yield('content')
    </div>
    <script>
        const leftSidebar = document.getElementById('left-sidebar');
        const rightSidebar = document.getElementById('right-sidebar');
        const toggleLeftSidebar = document.getElementById('toggle-left-sidebar');
        const toggleRightSidebar = document.getElementById('toggle-right-sidebar');
        const toggllepublication = document.getElementById('publication');
    
        toggleLeftSidebar.addEventListener('click', () => {
            leftSidebar.classList.toggle('open');
            toggllepublication.classList.toggle('hidden');

            if (rightSidebar.classList.contains('open')) {
            rightSidebar.classList.remove('open');
            publication.classList.add('hidden');
        }
            
            

        });
    
        toggleRightSidebar.addEventListener('click', () => {
            
            rightSidebar.classList.toggle('open');
            toggllepublication.classList.toggle('hidden');


            if (leftSidebar.classList.contains('open')) {
            leftSidebar.classList.remove('open');
            publication.classList.add('hidden');
        }
                         
           
        });
    </script>
    @vite('resources/js/app.js')
    @vite('resources/js/ThemeChange.js')
</body>
<script src="https://unpkg.com/@themesberg/flowbite@latest/dist/flowbite.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"
    integrity="sha256-Rt7yC2o2dEnpkPLIL4sm/P4I5IbYd6I5FFN1qVj1ZmM=" crossorigin="anonymous"></script>

</html>