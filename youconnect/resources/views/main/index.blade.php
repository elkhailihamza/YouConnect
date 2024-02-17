
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
       
        transition: transform 0.3s;
    }
    #left-sidebar.close,
    #right-sidebar.close {
        display: none;
    }

    .messages{
        overflow-y: scroll;
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

        <div id="left-sidebar" class="w-1/4 ml-4 hidden md:block overflow-y-scroll dark:text-white dark:bg-gray-800 mx-4">
            
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">

                        <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                    </a>
                </li>
            </ul>
        </div>
</div>
                {{--Content a centre de page : les publication --}}

                <div id="publication" class="w-1/2 h-full max-h-screen overflow-y-auto overflow-hidden dark:text-white ">
                    <div class="space-y-4">
                        @if (isset($posts) && $posts->isNotEmpty())
                            @foreach ($posts as $post)
                                <a data-modal-target="default-modal-{{$post->id}}" data-modal-toggle="default-modal">
                                    <div class="border-0 rounded">
                                        <div class="w-full flex items-center justify-center bg-white dark:bg-gray-800">
                                            <img src="{{ asset('storage/'.$post->cover) }}" alt="Post" class="w-96 h-auto rounded-t">
                                        </div>
                                        <div class="p-4 border-0">
                                            <h2 class="font-bold text-lg">{{ $post->title }}</h2>
                                            <p>{{ $post->content }}</p>
                                        </div>
                                    </div>
                
                                    <div id="default-modal-{{$post->id}}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Terms of Service
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="default-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        With less than a month to go before the European Union enacts new consumer privacy
                                                        laws for its citizens, companies around the world are updating their terms of
                                                        service agreements to comply.
                                                    </p>
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        The European Unions General Data Protection Regulation (G.D.P.R.) goes into effect
                                                        on May 25 and is meant to ensure a common set of data rights in the European Union.
                                                        It requires organizations to notify users as soon as possible of high-risk data
                                                        breaches that could personally affect them.
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div
                                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="default-modal" type="button"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                                        accept</button>
                                                    <button data-modal-hide="default-modal" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="flex items-center justify-center">
                                <h1>No posts available at the time!</h1>
                            </div>
                        @endif
                    </div>
                </div>
                
            
            
            
            
       
        
        
        
        {{--right-sidebar--}}

        <div id="right-sidebar" class="w-1/4 ml-4 hidden md:block overflow-y-scroll dark:text-white dark:bg-gray-800 ">
            <div class="border-0 rounded p-4 mb-4">
                <h2 class="font-bold mb-2">Utilisateurs à suivre</h2>
                <ul>
                    @foreach ($users as $user)
                    <li class="mb-2 flex justify-between items-center hover:bg-gray-100 dark:hover:bg-gray-700">
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


