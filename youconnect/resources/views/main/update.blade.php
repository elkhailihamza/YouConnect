@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="max-w-[680px] mx-auto my-20 p-5 bg-[#FFFFFF] dark:bg-[#242526] rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-5 dark:text-gray-300 text-blue-700 text-center">Update Your Post</h1>
        <div>
            <div class="flex self-start justify-self-start w-40">
                @if (!empty($post->user->avatar))
                <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="User"
                    class="w-8 h-8 rounded-full mr-2">
                @else
                <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                @endif
                <div class="grid">
                    <div><span class="dark:text-white text-[15px] font-medium">{{
                            $post->user->name }}</span></div>
                    <span class="text-[13px] w-44 text-stone-500">{{ $post->created_at->diffForHumans()}}</span>
                </div>
            </div>
        <form action="{{ route('posts.storeUpdate', [$post->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <textarea style="resize: none; height: 175px;" name="content"
                    placeholder="What's on your mind, {{Auth::user()->name}}?" required minlength="1"
                    maxlength="300"
                    class="mt-1 p-2.5 block w-full rounded-md shadow-sm dark:bg-[#242526] dark:text-gray-100">{{$post->content}}</textarea>
            </div>
            @if ($post->cover != null)
            <div class="w-full border-t flex items-center justify-center bg-white dark:bg-[#242526]">
                <img src="{{ asset('storage/' . $post->cover) }}" alt="Post" class="w-96 h-auto">
            </div>
            @endif
            <div id="post-image">
                <div class="relative">
                    <input name="cover"
                        class="sr-only" 
                        id="file_input" 
                        type="file">
                    <label for="file_input" class="block bg-green-100 p-2.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-[#242526] dark:border-gray-600 dark:placeholder-gray-400 my-12 text-center">
                        <span class="block ">Update Picture</span>
                        <span class="absolute top-0 right-0 p-1 -mt-2 -mr-2 bg-red-500 text-white rounded-full hidden">New!</span>
                    </label>
                </div>
                
                <div class="flex items-center justify-center">
                    <button type="submit"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection
