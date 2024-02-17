@if(!in_array(Route::currentRouteName(), ['login', 'register', 'main.posts']))
<div class="container-xl flex justify-between">
    <div class="fixed inset-0 mt-[70px] w-60">
        {{--left-sidebar--}}
        <div id="left-sidebar"
            class="w-72 h-full left-0 mr-4 hidden md:block border-r-2 border-gray-600 dark:border-white"
            style="border-right-width: 1px;">
            <div class="h-full px-3 py-2 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <div class="text-center w-full p-1">
                        <h1 class="text-gray-800 dark:text-white">Conversations</h1>
                    </div>
                    <hr>
                    <li>
                        <a href="#"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <img src="https://via.placeholder.com/50" alt="User" class="w-5 h-5 rounded-full mr-2">
                            <span class="flex-1 ms-3 whitespace-nowrap">Conversation 3</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{--right-sidebar--}}
    <div id="right-sidebar"
        class="fixed justify-self-end h-full right-0 mt-[65px] hidden md:block overflow-y-scroll dark:text-white dark:bg-gray-800 border-gray-600 dark:border-white"
        style="border-left-width: 1px;">
        <div class="rounded w-60 p-4 mb-4 text-center">
            <h2 class="font-bold mb-2">Utilisateurs à suivre</h2>
            <ul>
                @foreach ($users as $user)
                <li
                    class="mb-2 flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <div class="flex self-start justify-self-start">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-8 h-8 rounded-full mr-2">
                        <div class="overflow-hidden overflow-ellipsis"><span class="dark:text-white truncate">{{
                                $user->username }}</span></div>
                    </div>
                    <div class="relative inline-block text-left">

                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-sm font-semibold text-gray-900"
                            type="button"><svg fill="#000000" class="dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                                height="24" viewBox="0 -960 960 960" width="24">
                                <path
                                    d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif