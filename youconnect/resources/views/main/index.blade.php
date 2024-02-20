@extends('layouts.app')


@section('content')

{{--Content a centre de page : les publication --}}
<div class="mt-28 "></div>
<div id="publication" class="mt-28  max-h-screen container-xl dark:text-white">
    <div class="space-y-1">
        @if (isset($posts) && $posts->isNotEmpty())
        @foreach ($posts as $post)
        <div class="rounded shadow-md lg:w-[680px] bg-[#FFFFFF] dark:bg-[#242526]">
            <div class="p-4">
                <div class="flex self-start justify-self-start w-40">
                    <img src="https://via.placeholder.com/50" alt="User" class="w-[40px] h-[40px] rounded-full mr-2">
                    <div class="grid">
                        <div><span class="dark:text-white text-[15px] font-medium">{{
                                $post->user->username }}</span></div>
                        <span class="text-[13px] w-44 text-stone-500">{{ $post->created_at }}</span>
                    </div>
                </div>
                <div class="flex justify-between ms-2 mt-1">
                    <h2 class="text-[13px]">{{ $post->content }}</h2>
                </div>
            </div>
            @if ($post->cover != null)
            <div class="w-full border-t flex items-center justify-center bg-white dark:bg-[#242526]">
                <img src="{{ asset('storage/' . $post->cover) }}" alt="Post" class="w-96 h-auto">
            </div>
            @endif
            <div class="h-16 dark:bg-[#242526] border-t rounded-b">
                <div data-post-id="{{ $post->id }}" class="flex justify-around items-center w-full h-full likeButton">
                    <div>
                        <div class="flex gap-2 hover:underline cursor-pointer">
                            <span class="likes-count">{{ $post->likes->count() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-heart">
                                <path
                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                </path>
                            </svg>
                            <span>Like</span>
                        </div>
                    </div>
                    <div>
                        <a class="flex gap-2 hover:underline cursor-pointer" data-modal-target="default-modal-{{$post}}"
                            data-modal-toggle="default-modal-{{$post}}">
                            <span>{{ $post->comments->count() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-message-square">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span>Comment</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="default-modal-{{$post}}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal-{{$post}}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            With less than a month to go before the European Union enacts new consumer privacy laws for
                            its citizens, companies around the world are updating their terms of service agreements to
                            comply.
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May
                            25 and is meant to ensure a common set of data rights in the European Union. It requires
                            organizations to notify users as soon as possible of high-risk data breaches that could
                            personally affect them.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal-{{$post}}" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                            accept</button>
                        <button data-modal-hide="default-modal-{{$post}}" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-3"></div>
        @endforeach
        @else
        <div>
            <h1>No posts available at the time!</h1>
        </div>
        @endif
    </div>
</div>


@endsection