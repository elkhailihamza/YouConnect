@extends('layouts.app')

@section('content')
<div class="mt-20 mb-12 max-h-screen container-xl dark:text-white">
    <div class="rounded shadow-md dark:bg-[#242526]">
        @if ($friends->isEmpty())
            <p>Aucun ami pour le moment.</p>
        @else
            @foreach ($friends as $friend)
                <div class="flex items-start justify-between ">
                    <div class="flex items-start">
                        <div class="flex rounded-lg shadow-md p-4">
                            <img src="{{ $friend->avatar ? asset('storage/' . $friend->avatar) : 'https://via.placeholder.com/50' }}"
                            alt="User" class="w-8 h-8 rounded-full mr-2">                            
                            <p class="text-lg font-semibold dark:white">{{ $friend->name }}</p>
                            
                        </div>
                        
                    </div>
                    
                    <div class="mt-5 ms-3">
                        <p class="text-gray-600">{{ $friend->created_at->format('d/m/Y H:i') }}</p>
                        <div class="h-16 border-t select-none rounded-b flex text-center items-center justify-around bg-white dark:bg-[#242526]">
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
