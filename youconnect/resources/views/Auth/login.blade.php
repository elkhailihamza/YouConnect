@extends('layouts.app')

@section('content')


<div class="container mx-auto mt-5">
    <div class="max-w-lg mx-auto my-10 bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md mt-24">
        @if (session('error'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1 1 0 0 1-1.415 1.414l-2.829-2.828-2.828 2.828a1 1 0 1 1-1.414-1.414l2.828-2.829-2.828-2.828a1 1 0 0 1 1.414-1.414l2.828 2.828 2.829-2.828a1 1 0 0 1 1.415 1.414l-2.828 2.828 2.828 2.829z"/></svg>
        </span>
    </div>
@endif
        
        <h1 class="text-2xl font-semibold mb-5 text-center dark:text-white-700 text-blue-700">Login</h1>
        <form class="p-5" action="{{ route('login') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-4 ">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" placeholder="Email.." id="email" name="email" class="mt-1 p-2.5 block w-full rounded-md border border-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-100 dark:bg-gray-700 dark:text-gray-100" required>
            </div>
            <div class="mb-4 ">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" placeholder="Password.." id="password" name="password" class="mt-1 p-2.5 block w-full rounded-md border border-blue-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-100 dark:bg-gray-700 dark:text-gray-100" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Login</button>
                <a href="{{ route('register') }}" class="text-sm text-indigo-500 hover:text-indigo-700">Create an account</a>
            </div>
        </form>
    </div>
</div>
@endsection
