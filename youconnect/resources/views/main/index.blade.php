@extends('layouts.app')


@section('content')


{{--Content a centre de page : les publication --}}
<div class="mt-28 "></div>
<div id="publication" class="mt-28  max-h-screen container-xl dark:text-white">
    <div class="space-y-1">
        @if (isset($posts) && $posts->isNotEmpty())
        @foreach ($posts as $post)
        <div class="rounded shadow-md lg:w-[680px] bg-[#FFFFFF] dark:bg-[#242526]">
            <div class="p-4 flex justify-between">
                <div>
                    <div class="flex self-start justify-self-start w-40">
                        <img src="https://via.placeholder.com/50" alt="User"
                            class="w-[40px] h-[40px] rounded-full mr-2">
                        <div class="grid">
                            <div><span class="dark:text-white text-[15px] font-medium">{{
                                    $post->user->name }}</span></div>
                            <span class="text-[13px] w-44 text-stone-500">{{ $post->created_at }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between ms-3 mt-2">
                        <h2 class="text-[13px]">{{ $post->content }}</h2>
                    </div>
                </div>
                <div>
                    <button id="dropdown" data-dropdown-toggle="post-{{$post->id.'-'.$post->user->name}}"
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-sm font-semibold text-gray-900"
                        type="button"><svg fill="#000000" class="dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                            height="24" viewBox="0 -960 960 960" width="24">
                            <path
                                d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="post-{{$post->id.'-'.$post->user->name}}"
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
                        <div class="flex gap-2  cursor-pointer">
                            <span class="likes-count">{{ $post->likes->count() }}</span>
                            {{--button de like--}}
                            <button type="button" class="like-button btnlike" data-post-id="{{$post->id }}"><i
                                    class="fa-solid fa-heart fa-lg"></i></button>
                        </div>
                    </div>

                    <div>
                        <a class="flex gap-2  cursor-pointer" data-modal-target="default-modal-{{$post}}"
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
                                <div><span class="dark:text-white text-[15px] font-medium">{{ auth()->user()->name
                                        }}</span></div>
                                <textarea name="content" minlength="1" maxlength="255" required
                                    class="comment-content block p-2.5 h-[105px] resize-none w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button type="button" data-post-id="{{ $post->id }}"
                                        class="submit-comment text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="p-1 ms-5 mt-2 flex">
                        <h2 class="text-xl"><span class="underline">Comments:</span> <span class="comment-count"
                                data-post-id="{{ $post->id }}">{{ $post->comments->count() }}</span></h2>
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
                    <div data-post-id="{{ $post->id }}"
                        class="comments-container max-h-[350px] rounded overflow-y-auto"></div>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btnlike').forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-post-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("like.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ post_id: postId })
                })
                    .then(response => response.json())
                    .then(data => {
                        const likeButton = document.querySelector(`.btnlike[data-post-id="${postId}"] i`);
                        const likesCount = document.querySelector(`.likeButton[data-post-id="${postId}"] .likes-count`);
                        if (data.liked) {
                            likeButton.classList.add('text-red-500'); // Change la couleur du cœur en rouge
                        } else {
                            likeButton.classList.remove('text-red-500'); // Retire la couleur rouge du cœur
                        }
                        likesCount.textContent = data.likesCount;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });

</script>


@endsection