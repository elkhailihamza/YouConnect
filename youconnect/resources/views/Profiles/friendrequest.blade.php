@extends('layouts.app')

@section('content')
<div  class="mt-20 md:mt-25 mb-12  max-h-screen container-xl dark:text-white ">
    <div class="rounded shadow-md mt-12 dark:bg-[#242526]">
        @if ($receivedRequests->isEmpty())
            <p>Currently, there are no friend requests received.</p>
        @else
            @foreach ($receivedRequests as $request)
                <div class="flex lg:w-[680px]  justify-between px-5" >
                    <div class="flex items-center">
                        <div class="flex rounded-lg  p-4">
                            <img src="{{ $request->sender->avatar ? asset('storage/' . $request->sender->avatar) : 'https://via.placeholder.com/50' }}"
                            alt="User" class="w-8 h-8 rounded-full mr-2">     
                            <p class="text-lg font-semibold dark:white">{{ $request->sender->name }}</p>
                           
                        </div>
                        <p class="text-gray-600">{{ $request->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mt-5 ms-3">
                        <div class="h-16  select-none rounded-b flex text-center items-center justify-around  dark:bg-[#242526]">
                            <div class="flex justify-end ">
                                <!-- Boutons pour accepter ou rejeter l'invitation -->
                                <form action="{{ route('accept-request', $request->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md mr-2">Accepter</button>
                                </form>
                                <form action="{{ route('reject-request', $request->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md">Rejeter</button>
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
