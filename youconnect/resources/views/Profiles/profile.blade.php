@extends('layouts.app')

@section('content')

<div id="profile" class="mt-28 mb-12 max-h-screen container-xl dark:text-white">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1 1 0 0 1-1.415 1.414l-2.829-2.828-2.828 2.828a1 1 0 1 1-1.414-1.414l2.828-2.829-2.828-2.828a1 1 0 0 1 1.414-1.414l2.828 2.828 2.829-2.828a1 1 0 0 1 1.415 1.414l-2.828 2.828 2.828 2.829z"/></svg>
        </span>
    </div>
@endif

    <h1 class="text-2xl font-semibold mb-5 dark:text-gray-300 text-blue-700 ">Profile details</h1>

    <div class="rounded shadow-md lg:w-[680px] bg-[#FFFFFF] dark:bg-[#242526]">
        
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                    <span class="text-[15px] font-medium">{{ $user->name }}</span>
                </div>
                <span class="text-[13px] text-stone-100"><i class="fa-solid fa-envelope"></i> {{ $user->email }}</span>
            </div>
            <div class="mt-2">
                <h2 class="text-[13px]">{{ $user->bio }}</h2>
            </div>
        </div>
        <div class="h-16 border-t rounded-b flex text-center items-center justify-between bg-white dark:bg-[#242526]">
            <div class="flex items-center text-center  gap-2 cursor-pointer">
                <span class="likes-count text-center ">{{ $user->posts->count() }} Posts</span>
            </div>
        </div>
    </div>

    <div class="mt-2 mb-18 max-h-screen w-full container-xl dark:text-white">
        <h1 class="text-2xl font-semibold mb-5 dark:text-gray-300 text-blue-700">Edit Profile</h1>
        <form class="rounded shadow-md w-full bg-white dark:bg-[#242526]  dark:text-white p-8 " method="POST" action="{{ route('profiles.update', ['user' => $user]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div class="mb-4 w-full">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input id="name" type="text" class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="name" value="{{ $user->name }}" required autofocus>
            </div>
    
            <div class="mb-4 w-full">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" type="email" class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="email" value="{{ $user->email }}" required>
            </div>
    
            <div class="mb-4 w-full">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" type="password" class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="password" >
            </div>
    
            <div class="mb-4 w-full">
                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                <textarea id="bio" class="form-textarea dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="bio">{{ $user->bio }}</textarea>
            </div>
    
            <div class="mb-4 w-full">
                <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Avatar</label>
                <input id="avatar" type="file" class="form-input dark:text-white w-full border border-gray-600 rounded" name="avatar">
            </div>
    
            <div class="flex items-center justify-center mt-6">
                <button type="submit" class="px-4 py-2 mb-18 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Save Changes</button>
            </div>
        </form>
    </div>
    
@endsection
