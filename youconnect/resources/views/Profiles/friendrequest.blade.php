@extends('layouts.app')

@section('content')
<div  class="mt-20 mb-12 max-h-screen container-xl dark:text-white ">
    <div class="rounded shadow-md bg-[#FFFFFF] dark:bg-[#242526]">
        @if ($receivedRequests->isEmpty())
            <p>Aucune demande reçue pour le moment.</p>
        @else
            @foreach ($receivedRequests as $request)
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <p class="text-lg font-semibold">{{ $request->sender->name }}</p>
                            <img src="{{ $request->sender->avatar }}" alt="">
                            <p class="text-gray-600">{{ $request->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="mt-5 ms-3">
                        <div class="h-16 border-t select-none rounded-b flex text-center items-center justify-around bg-white dark:bg-[#242526]">
                            <div class="flex justify-end mt-4">
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
