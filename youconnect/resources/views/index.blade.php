
@extends('layouts.app')


<style>
    ::-webkit-scrollbar {
      width: 2px;
    }
  
    ::-webkit-scrollbar-thumb {
      background-color: #ffffff;
      border-radius: 4px;
    }
  
    ::-webkit-scrollbar-track {
      background-color: #e5cf0c;
      border-radius: 4px;
    }

    @media (max-width: 767px) {
    #left-sidebar {
        display: none;
    }

    #right-sidebar {
        display: none;
    }
    #publication{
        width: 100%;
    }
}
  </style>
  
@section('content')
    <div class="container mx-auto py-4 flex  " style="height: 88vh;">
        <button id="toggle-left-sidebar" class="fixed left-0 top-0 p-4 bg-green-900 text-white">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <div id="left-sidebar" class="w-1/4 mr-4">
            <div class="border rounded p-4 mb-4 dark:text-white">
                <h2 class="font-bold mb-2">Navigation</h2>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Explorer</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">Profil</a></li>
                </ul>
            </div>
        </div>
        
        <div id="publication" class="  w-1/2 max-h-screen overflow-y-auto overflow-hidden dark:text-white">
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
            </div>
        </div>

       
        <button id="toggle-right-sidebar" class="fixed right-0 p-4 dark:bg-gray-900 bg-black-900 text-white">
            <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <div id="right-sidebar" class="w-1/4 ml-4 dark:text-white">
            <div class="border rounded p-4 mb-4">
                <h2 class="font-bold mb-2">Utilisateurs à suivre</h2>
                <ul>
                    <li>
                        <div class="flex items-center mb-2">
                            <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                            <span>Nom de l'utilisateur 1</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center mb-2">
                            <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                            <span>Nom de l'utilisateur 2</span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center mb-2">
                            <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                            <span>Nom de l'utilisateur 3</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.getElementById('toggle-left-sidebar').addEventListener('click', function() {
            document.getElementById('left-sidebar').classList.toggle('hidden');
        });

        document.getElementById('toggle-right-sidebar').addEventListener('click', function() {
            document.getElementById('right-sidebar').classList.toggle('hidden');
        });
    </script>
@endsection