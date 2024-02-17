@extends('layouts.app')


@section('content')

{{--Content a centre de page : les publication --}}
<div id="publication" class="mt-28 w-[682px] max-h-screen container-xl overflow-y-auto dark:text-white">
    <div class="space-y-4">
        @if (isset($posts) && $posts->isNotEmpty())
        @foreach ($posts as $post)
        <a data-modal-target="default-modal-{{$post}}" data-modal-toggle="default-modal-{{$post}}">
            <div class="rounded dark:bg-[#242526]">
                <div class="p-4">
                    <div class="flex self-start justify-self-start w-40">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-10 h-10 rounded-full mr-2">
                        <div class="grid">
                            <div><span class="dark:text-white font-medium">{{
                                    $post->user->username }}</span></div>
                            <span class="text-[12px] w-44 text-stone-500">{{ $post->created_at }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between ms-2 mt-1">
                        <h2 class="text-sm">{{ $post->title }}</h2>
                    </div>
                </div>
                @if ($post->cover != null)
                <div class="w-full border-t flex items-center justify-center bg-white dark:bg-[#242526]">
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="Post" class="w-96 h-auto">
                </div>
                @endif
            </div>

            <div id="default-modal-{{$post}}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 flex gap-2 w-full md:p-5 space-y-4">
                            <div class="h-[450px] w-[400px]">
                                <img class="h-full w-full rounded" src="{{ asset('storage/'.$post->cover) }}" alt="">
                            </div>
                            <div class="border-l-2">
                                <h3>Desctiption</h3>
                                <p>{{ $post->content }}</p>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

                        </div>
                    </div>
                </div>
            </div>
        </a>
        <div class="h-5"></div>
        @endforeach
        @else
        <div>
            <h1>No posts available at the time!</h1>
        </div>
        @endif
    </div>
</div>

@endsection