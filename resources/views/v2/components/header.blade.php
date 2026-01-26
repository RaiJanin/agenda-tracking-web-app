            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between p-4 mb-[6px]">
                    <button id="menu-toggle" class="md:hidden text-gray-500">
                        <i data-feather="menu" class="md:hidden"></i>
                    </button>
                    <div class="flex items-center space-x-4 pl-4">
                        <div class="relative">
                            <i data-feather="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex items-center sm:space-x-2 md:mr-25">
                        <button class="p-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 hidden md:block">
                            <i data-feather="bell"></i>
                        </button>
                        <div class="flex items-center">
                            <button id="user-btn" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-500">
                                <i data-feather="user"></i>
                            </button>
                            <div id="user-dropdown" class="dropdown-transition origin-top-right fixed top-5 right-5 mt-10 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10 hidden">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">Signed in as</p>
                                    <p class="text-sm text-gray-500 truncate">{{ auth()->user()->name }}</p>
                                </div>
                                <div class="pt-1 pb-1">
                                    <a href="#" class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:text-gray-500">Notifications <span class="ml-1 bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">3 new</span></a>
                                </div>
                                <!-- <div class="pt-1 border-t border-gray-100">
                                    <button class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:text-gray-500" id="logout-button">Sign out</button>
                                </div> -->
                            </div>
                        </div>
                        <div class="hidden md:inline-block">
                            <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs font-medium text-gray-500">{{ auth()->user()->specific_role }}</p>
                        </div>
                    </div>
                </div>
            </header>