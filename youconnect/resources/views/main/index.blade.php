@extends('layouts.app')


@section('content')



<div id="publication" class="mt-16   md:w-[680px] w-[450px] max-h-screen container-xl dark:text-white">
    <div class="space-y-1">
        @auth
        @if ($userId === Auth::id())
        <div class="container mx-auto">
            <div class="max-w-[680px] mx-auto my-10 p-5 bg-[#FFFFFF] dark:bg-[#242526] rounded-lg shadow-md">
                <h6 class="text-2xl font-semibold mb-5 dark:text-gray-300 text-blue-700 text-start">Create Post</h6>
                <form action="{{ route('main.posts.store', ['user_id' => Auth::user()->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-4">
                        <textarea style="resize: none; " name="content"
                            placeholder="What's on your mind, {{Auth::user()->name}}?" required minlength="1"
                            maxlength="300"
                            class="mt-1 p-2.5 block w-full rounded-md shadow-sm dark:bg-[#242526] dark:text-gray-100"></textarea>
                    </div>
                    <div id="post-image">
                        <div class="mb-4">
                            <div
                                class="border border-[#6B7280] dark:bg-[#242526] flex items-center justify-center rounded">
                                <label
                                    class="block text-sm flex cursor-pointer w-full justify-between font-medium items-center gap-2 dark:text-white"
                                    for="file_input"><span class="p-3.5 text-[#6B7280] ">Upload
                                        image</span><svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 24 24" fill="none" stroke="#686868" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                        <path d="M14 3v5h5M12 18v-6M9 15h6" />
                                    </svg>
                                    <input name="cover"
                                        class="block sr-only text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-[#242526] dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" type="file">
                                </label>
                            </div>
                            <div class="hidden" id="preview-container">
                                <label for="preview">Preview:</label>
                                <img src="" class="mt-4 mx-auto max-h-40" id="preview">
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @endauth
        @if (isset($posts) && $posts->isNotEmpty())
        @foreach ($posts as $post)
        <div class="rounded shadow-md lg:w-[680px] bg-[#FFFFFF] dark:bg-[#242526]">
            <div class="p-4 flex justify-between">
                <div>
                    <div class="flex self-start justify-self-start w-40">
                        @if (!empty($post->user->avatar))
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="User"
                            class="w-8 h-8 rounded-full mr-2">
                        @else
                        <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                        @endif
                        <div class="grid">
                            <div><a href="{{route('profiles.profile', $post->user->id)}}"
                                    class="dark:text-white text-[15px] font-medium">{{
                                    $post->user->name }}</a></div>
                            <span class="text-[13px] w-44 text-stone-500">{{ $post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    <div class="flex justify-between ms-3 mt-2">
                        @php
                        $description = $post->content;
                        $description = preg_replace('/#(\w+)/', '<span class="blue-tag">#$1</span>', $description);
                        @endphp
                        <h2 class="text-[13px]"><span>{!! $description !!}</span></h2>
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
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44  dark:bg-[#242520]">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown">
                            @if(isset(Auth::user()->id))
                            @if($post->user->id == Auth::user()->id)
                            <li>
                                <a class="w-full block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    href="{{ route('posts.update',$post->id) }}"><i
                                        class="fa-solid fa-pencil"></i>Update Poste</a>
                            </li>
                            @endif
                            @endif
                            @if(isset(Auth::user()->id) )
                            @if($post->user->id == Auth::user()->id)
                            <li>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><i
                                            class="fa-solid fa-trash-can"></i> Delete Post</button>
                                </form>
                            </li>
                            @endif
                            @endif

                            <li>
                                <a data-post-id="{{$post->id}}"
                                    class="block w-full cursor-pointer flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><i
                                        class="fa-solid fa-clipboard"></i> Copie le lien</a>

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
                        <div class="flex gap-2 dark:hover:bg-[#292929] rounded px-5 py-3 like-button btnlike cursor-pointer"
                            data-post-id="{{$post->id }}">
                            <span class="likes-count">{{ $post->likes->count() }}</span>
                            {{--button de like--}}
                            @if (Auth::check() && Auth::user()->likes->contains('post_id', $post->id))
                            <button type="button"><i class="fa-solid fa-heart fa-lg"></i></button>
                            @else
                            <button type="button"><i class="fa-solid fa-heart fa-lg"></i></button>
                            @endif
                        </div>
                    </div>

                    <div>
                        <a class="flex gap-2 load-comments dark:hover:bg-[#292929] rounded px-5 py-3 cursor-pointer"
                            data-post-id="{{ $post->id }}" data-modal-target="comments-{{$post->id}}"
                            data-modal-toggle="comments-{{$post->id}}">
                            <span data-post-id="{{ $post->id }}" class="comment-count">{{ $post->comments->count()
                                }}</span>
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
        <div id="comments-{{$post->id}}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative w-full bg-white rounded-lg shadow dark:bg-gray-700">
                    @auth
                    <!-- Modal header -->
                    <div
                        class="flex items-center w-full justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <div class="flex w-full">
                            @if (!empty(Auth::user()->avatar))
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User"
                                class="w-8 h-8 rounded-full mr-2">
                            @else
                            <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                            @endif
                            <div class="grid w-full">
                                <div><span class="dark:text-white text-[15px] font-medium">{{ auth()->user()->name
                                        }}</span></div>
                                <textarea data-post-id="{{ $post->id }}" minlength="1" maxlength="255" required
                                    class="block p-2.5 h-[105px] comment-content resize-none w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..."></textarea>
                                <div class="flex justify-end mt-2">
                                    <button type="button" data-post-id="{{ $post->id }}"
                                        class="submit-comment text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth
                    @guest
                    <div class="text-center p-3">
                        <span>Log in to use this Feature!</span>
                    </div>
                    @endguest
                    <!-- Modal body -->
                    <div class="p-1 ms-5 mt-2 flex">
                        <h2 class="text-xl"><span>Comments:</span> <span class="comment-count"
                                data-post-id="{{ $post->id }}">{{ $post->comments->count() }}</span></h2>
                    </div>
                    <div data-post-id="{{ $post->id }}"
                        class="comments-container max-h-[300px] rounded overflow-y-auto">
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
                            likeButton.classList.add('text-red-500');
                        } else {
                            likeButton.classList.remove('text-red-500');
                        }
                        likesCount.textContent = data.likesCount;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });





</script>

@endsection