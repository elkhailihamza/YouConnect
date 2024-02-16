
@extends('layouts.app')


<style>
    ::-webkit-scrollbar {
    display: none;  
    }
  
    ::-webkit-scrollbar-thumb {
      background-color: #ffffff;
      border-radius: 4px;
    }
  
    ::-webkit-scrollbar-track {
      background-color: #959595;
      border-radius: 4px;
    }

    @media (max-width: 767px) {
        #left-sidebar,
    #right-sidebar {
        display: none;
        width: 100%;
        
    }

    #left-sidebar.open,
    #right-sidebar.open {
        display: block;
        margin-top: 30px; 
        margin-right: 10px;
    }
    #left-sidebar.close,
    #right-sidebar.close {
        display: none;
    }
        

    
    #publication{
        width: 100%;
        margin-top: 30px;
    }
    .hidden{
        display: none;
    }
       }
  </style>
  
@section('content')
    <div class="container mx-auto py-4 flex  " style="height: 88vh;">
        
        
        {{--left-sidebar--}}
        <div id="left-sidebar" class=" w-1/4 mr-4 hidden md:block" style="z-index: -999;">
            
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Explore</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                            <path
                                d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                            <path
                                d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Sign Up</span>
                    </a>
                </li>
            </ul>
        </div>
    
        </div>
                {{--Content a centre de page : les publication --}}

        <div id="publication" class="  w-1/2 max-h-screen overflow-y-auto overflow-hidden dark:text-white ">
            
            <div class="space-y-4">
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 1</h2>
                        <p>Description de la publication 1...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 2</h2>
                        <p>Description de la publication 2...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 3</h2>
                        <p>Description de la publication 3...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 3</h2>
                        <p>Description de la publication 3...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 3</h2>
                        <p>Description de la publication 3...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 3</h2>
                        <p>Description de la publication 3...</p>
                    </div>
                </div>
                <div class="border rounded">
                    <img src="https://via.placeholder.com/600x400" alt="Post" class="w-full h-auto rounded-t">
                    <div class="p-4">
                        <h2 class="font-bold text-lg">Titre de la publication 3</h2>
                        <p>Description de la publication 3...</p>
                    </div>
                </div>
            </div>
        </div>

       
        
        
        
        {{--right-sidebar--}}

        <div id="right-sidebar" class="w-1/4 ml-4 hidden md:block overflow-y-scroll dark:text-white dark:bg-gray-800">
            <div class="border rounded p-4 mb-4">
                <h2 class="font-bold mb-2">Utilisateurs à suivre</h2>
                <ul>
                    @foreach ($users as $user)
                    <li class="mb-2 flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                            <span class="dark:text-white">{{ $user->username }}</span>
                        </div>
                        <div><button class="bg-red-500 hover:bg-red-700 text-white font-bold px-2  rounded-full">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 rounded-full">
                            <i class="fa-solid fa-user-plus"></i>
                        </button></div>
                        
                    </li>
                    @endforeach
                </ul>
                
                
            </div>
        </div>
        
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
    
@endsection


