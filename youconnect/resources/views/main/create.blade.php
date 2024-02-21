{{-- create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-14">
    <div class="max-w-lg mx-auto my-10 bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md mt-25">
        <h1 class="text-2xl font-semibold mb-5 dark:text-gray-300 text-blue-700 text-center">Create Post</h1>
        <form action="{{ route('main.posts.store', ['user_id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" id="name" placeholder="title.." name="title"
                    class="mt-1 p-2.5 block w-full rounded-md border border-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-100 dark:bg-gray-700 dark:text-gray-100"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                <textarea style="resize: none; height: 250px;" placeholder="Content.." minlength="1" maxlength="414"
                    class="mt-1 p-2.5 block w-full rounded-md border border-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-100 dark:bg-gray-700 dark:text-gray-100"
                    name="content"></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                    file</label>
                <input name="cover"
                    class="block p-2.5 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input" type="file">
            </div>
            <div class="flex items-center justify-center">
                <button type="submit"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection