@extends('layouts.app')


@section('content')

{{--Content a centre de page : les publication --}}
<div class="mt-28 "></div>
<div id="publication" class="mt-28 w-[682px] max-h-screen container-xl dark:text-white">
    <div class="space-y-1">
        @if (isset($posts) && $posts->isNotEmpty())
        @foreach ($posts as $post)
        <div class="rounded shadow-md w-[680px] bg-[#FFFFFF] dark:bg-[#242526]">
            <div class="p-4 flex justify-between">
                <div>
                    <div class="flex self-start justify-self-start w-40">
                        <img src="https://via.placeholder.com/50" alt="User"
                            class="w-[40px] h-[40px] rounded-full mr-2">
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
                <div>
                    <button id="dropdown" data-dropdown-toggle="post-{{$post->id.'-'.$post->user->username}}"
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-sm font-semibold text-gray-900"
                        type="button"><svg fill="#000000" class="dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                            height="24" viewBox="0 -960 960 960" width="24">
                            <path
                                d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="post-{{$post->id.'-'.$post->user->username}}"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown">
                            <li>
                                <a href="#"
                                    class="block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="#008B00" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg> Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                    </svg>Delete</a>
                            </li>
                        </ul>
                    </div>
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
                        <a class="flex gap-2 hover:underline cursor-pointer" data-modal-target="comments-{{$post->id}}"
                            data-modal-toggle="comments-{{$post->id}}">
                            <span class="comment-count" data-post-id="{{ $post->id }}">{{ $post->comments->count() }}</span>
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
        @endforeach
        @foreach ($posts as $post)
        @auth
        <div id="comments-{{$post->id}}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative w-full bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center w-full justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <div class="flex w-full">
                            <img src="https://via.placeholder.com/50" alt="User"
                                class="w-[40px] h-[40px] rounded-full mr-2">
                            <div class="grid w-full">
                                <div><span class="dark:text-white text-[15px] font-medium">{{ auth()->user()->username
                                        }}</span></div>
                                <textarea rows="4" name="content"
                                    class="comment-content block p-2.5 h-[200px] resize-none w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button data-post-id="{{ $post->id }}"
                                        class="submit-comment bg-blue-700 text-white p-2.5 rounded">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="p-1 ms-5 mt-2 flex">
                        <h2 class="text-xl"><span class="underline">Comments:</span> <span class="comment-count" data-post-id="{{ $post->id }}">{{ $post->comments->count() }}</span></h2>
                    </div>
                    @if ($post->comments->count() == 0)
                    <div class="text-center p-3">
                        <span>Be The first one to Comment!</span>
                    </div>
                    @else
                    <div class="p-4 md:px-5 flex justify-center">
                        <button data-post-id="{{ $post->id }}"
                            class="load-comments bg-blue-700 text-white p-2.5 rounded">Load Comments</button>
                    </div>
                    <div data-post-id="{{ $post->id }}" class="comments-container max-h-[200px] overflow-y-auto">

                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endauth
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