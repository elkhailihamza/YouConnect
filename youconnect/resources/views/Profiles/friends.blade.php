@extends('layouts.app')

@section('content')
<div class="mt-24 mb-12 max-h-screen container-xl dark:text-white">
    <h1 class="dark:text-white text-center">Friends</h1>

    <div class="rounded shadow-md mt-12 dark:bg-[#242526] mt-7 p-3">
        @if ($friends->isEmpty())
            <p>No friends at the moment.</p>
        @else
            @foreach ($friends as $friend)
                <div class="flex items-start justify-between lg:w-[680px]  ">
                    <div class=" items-start mb-5">
                        <div class=" rounded-lg flex ">
                            <img src="{{ $friend->avatar ? asset('storage/' . $friend->avatar) : 'https://via.placeholder.com/50' }}"
                            alt="User" class="w-8 h-8 rounded-full mr-2">                            
                            <p class="text-lg font-semibold dark:white">{{ $friend->name }}</p>
                            
                        </div>
                        <p class="text-gray-500">You are friends for {{ $friend->created_at->diffForHumans() }}</p>
                        
                    </div>
                    
                    <div>

                    </div>
                    
                    <div class=" ms-3">
                        <div class="h-16  select-none rounded-b flex text-center items-center justify-around  dark:bg-[#242526]">
                            <div class="flex justify-center ">
                                <!-- Boutons pour supprimer l'ami -->
                                <form action="{{ route('friends.delete', $friend) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md">Remove</button>
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
