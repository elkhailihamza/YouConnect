@extends('layouts.app')

@section('content')

<div id="profile" class="mt-20 mb-12 max-h-screen container-xl dark:text-white">

    <h1 class="text-2xl text-center md:w-[680px] w-[400px] font-semibold mb-5 dark:text-gray-300 text-blue-700 ">Profile details
    </h1>

    <div class="rounded shadow-md bg-[#FFFFFF] dark:bg-[#242526]">
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/50' }}"
                        alt="User" class="w-8 h-8 rounded-full mr-2">
                    <div class="grid">
                        <span class="text-[15px] font-medium">{{ $user->name }}</span>
                        <span class="text-[13px] text-stone-500">Created: {{ $user->created_at->diffForHumans()
                            }}</span>
                    </div>
                </div>
                <span class="text-[13px] text-stone-100"><i class="fa-solid fa-envelope"></i> {{ $user->email }}</span>
            </div>
            <div class="mt-2 ms-10">
                @if ($user->id === Auth::id())
                    <h2 class="text-[13px] ms-5">{{ $user->bio ?? 'Add a bio here!'}}</h2>
                @else
                    <h2 class="text-[13px] ms-5">{{ $user->bio ?? 'No Bio here!'}}</h2>
                @endif
            </div>
        </div>
        <div
            class="h-16 border-t select-none rounded-b flex text-center items-center justify-around bg-white dark:bg-[#242526]">
            <div class="gap-2">
                <a href="{{route('profiles.Myposts', $user->id)}}" class="likes-count items-center justify-center flex gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-crop">
                        <path d="M6.13 1L6 16a2 2 0 0 0 2 2h15"></path>
                        <path d="M1 6.13L16 6a2 2 0 0 1 2 2v15"></path>
                    </svg>{{ $user->posts->count() }} Posts</a>
            </div>
            
            
            <div>
                <span class="likes-count items-center justify-center flex gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
                        <path
                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                        </path>
                    </svg>{{ $user->comments->count() }} Comments</span>
            </div>
        </div>
    </div>

    @if ($user->id === Auth::id())
    <div class="mt-2 mb-18 max-h-screen w-full container-xl dark:text-white">
        <h1 class="text-2xl text-center font-semibold mb-5 dark:text-gray-300 text-blue-700">Edit Profile</h1>
        <form action="{{ route('profile.delete') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are You sure you want delete Your account ?')" class="block text-center w-full px-4 py-2 text-sm text-left text-gray-700 dark:text-gray-300 bg-red-800 dark:bg-red-700 focus:outline-none">Delete Account</button>
        </form>
        <form class="rounded shadow-md w-full bg-white dark:bg-[#242526]  dark:text-white p-8 " method="POST"
            action="{{ route('profiles.update', ['user' => $user]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4 w-full">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input id="name" type="text"
                    class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="name"
                    value="{{ $user->name }}" required autofocus>
            </div>

            <div class="mb-4 w-full">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" type="email"
                    class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="email"
                    value="{{ $user->email }}" required>
            </div>

            <div class="mb-4 w-full">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Password</label>
                <input id="current_password" type="password"
                    class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="password">
            </div>

            <div class="mb-4 w-full">
                <label for="password"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Password</label>
                <input id="password" type="password"
                    class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="password">
            </div>

            <div class="mb-4 w-full">
                <label for="password"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300"> verifier Password</label>
                <input id="password" type="password"
                    class="form-input dark:text-gray-900 text-lg w-full border border-gray-600 rounded" name="password">
            </div>

            <div class="mb-4 w-full">
                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bio</label>
                <textarea id="bio"
                    class="form-textarea dark:text-gray-900 text-lg w-full border border-gray-600 rounded"
                    name="bio">{{ $user->bio }}</textarea>
            </div>

            <div class="mb-4 w-full">
                <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Avatar</label>
                <input id="avatar" type="file" class="form-input dark:text-white w-full border border-gray-600 rounded"
                    name="avatar">
            </div>
            

            <div class="flex items-center justify-center mt-6">
                <button type="submit"
                    class="px-4 py-2 mb-18 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Save
                    Changes</button>
            </div>
        </form>
       

        
        
    </div>
    @endif

    @endsection