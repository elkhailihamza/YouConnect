@if(!in_array(Route::currentRouteName(), ['login', 'register', 'main.posts']))
<div class="container-xl flex justify-between no-scrollbar">
    <div class="fixed inset-0 mt-[70px] w-60">
        {{--left-sidebar--}}
        <div id="left-sidebar"
            class=" w-[275px] h-full left-0 mr-4 hidden md:block border-gray-600 dark:border-white">
            <div class="h-full px-3 py-2 pb-4 overflow-y-auto dark:bg-[#18191A]">
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
        class="fixed justify-self-end h-full right-0 mt-[65px] hidden md:block dark:text-white dark:bg-[#18191A]">
        <div class="rounded w-[275px] p-4 mb-4 text-center">
            <h2 class="font-bold mb-2">Utilisateurs à suivre</h2>
            <ul>
                @foreach ($users as $user)
                <li
                    class="mb-2 flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <div class="flex self-start justify-self-start w-[200px]">
                        <img src="https://via.placeholder.com/50" alt="User" class="w-[35px] h-[35px] rounded-full mr-2">
                        <div class="overflow-hidden overflow-ellipsis"><span class="dark:text-white truncate">{{
                                $user->username }}</span></div>
                    </div>
                    <div class="relative inline-block text-left">

                        <button id="dropdown" data-dropdown-toggle="user-{{$user->username.'-'.$user->id}}"
                            class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-sm font-semibold text-gray-900"
                            type="button"><svg fill="#000000" class="dark:fill-white" xmlns="http://www.w3.org/2000/svg"
                                height="24" viewBox="0 -960 960 960" width="24">
                                <path
                                    d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="user-{{$user->username.'-'.$user->id}}"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdown">
                                <li>
                                    <a href="#"
                                        class="block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#00b1ff" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg> Befriend</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block flex gap-1 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#FF0000" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                                        </svg>Block</a>
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