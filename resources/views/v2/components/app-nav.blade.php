        @php $adminAccess = auth()->user()->role === 'admin'; @endphp
        <div class="sidebar bg-white border-r border-gray-200 flex-shrink-0 transition-all duration-300 ease-in-out overflow-auto" id="sidebar">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <button id="open-sidebar" class="text-gray-500 hover:text-gray-700 py-3 ml-2 hidden">
                    <i data-feather="chevron-right"></i>
                </button>
                <div id="side-logo">
                    <h1 class="text-xl font-bold text-blue-800 whitespace-nowrap">Company Logo</h1>
                    <p class="text-sm font-small">Company name</p>
                </div>
                <button id="toggle-sidebar" class="text-gray-500 hover:text-gray-700">
                    <i data-feather="chevron-left"></i>
                </button>
                <button id="mobile-toggle-sidebar" class="text-gray-500 hover:text-gray-700 py-3 ml-2 md:hidden">
                    <i data-feather="chevron-left"></i>
                </button>
            </div>
            <nav class="p-4">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 px-2 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group transition-all duration:300 ease-in-out">
                        <i data-feather="home"></i>
                        <span class="sidebar-text">Dashboard</span>
                        <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Dashboard</span>
                    </a>
                    <a href="{{ route('calendar') }}" class="flex items-center space-x-3 px-2 py-2 rounded-lg {{ request()->routeIs('calendar') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                        <i data-feather="calendar"></i>
                        <span class="sidebar-text">Calendar</span>
                        <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Calendar</span>
                    </a>
                    @if($adminAccess)
                    <div class="accordion-group">
                        <button class="w-full flex items-center justify-between p-2 rounded-lg {{ request()->routeIs('agenda.*') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                            <div class="flex items-center space-x-3">
                                <i data-feather="book-open"></i>
                                <span class="sidebar-text">Agenda</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Agenda</span>
                            </div>
                            <i data-feather="chevron-down" class="accordion-arrow transition-transform duration-300 ease-in-out"></i>
                        </button>
                        <div class="accordion-content hidden pl-2 mt-1 space-y-1 transition-transform duration:300 ease-in-out">
                            <a href="{{ route('agenda.create') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('agenda.create') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i class="fa-regular fa-calendar-plus text-2xl"></i>
                                <span class="sidebar-text">Create Agenda</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Create Agenda</span>
                            </a>
                            <a href="{{ route('agenda.view-all') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('agenda.view-all') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="layout"></i>
                                <span class="sidebar-text">All Agenda</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">View All Agenda</span>
                            </a>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('agenda.view-all') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('agenda.view-all') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                        <i data-feather="layout"></i>
                        <span class="sidebar-text">Agendas</span>
                        <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">View All Agenda</span>
                    </a>
                    @endif
                    @if(in_array(auth()->user()->role, ['admin', 'member']))
                    <div class="accordion-group">
                        <button class="w-full flex items-center justify-between p-2 rounded-lg {{ request()->routeIs('concerns.*') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                            <div class="flex items-center space-x-3">
                                <i data-feather="inbox"></i>
                                <span class="sidebar-text">Concerns</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Concerns</span>
                            </div>
                            <i data-feather="chevron-down" class="accordion-arrow transform transition-transform duration-200"></i>
                        </button>
                        <div class="accordion-content hidden pl-2 mt-1 space-y-1 transition-all duration:300 ease-in-out">
                            <a href="{{ route('concerns.all-concerns') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('concerns.all-concerns') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="trello"></i>
                                <span class="sidebar-text">All Concerns</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">View All Concerns</span>
                            </a>
                            <a href="{{ route('concerns.my-concerns') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('concerns.my-concerns') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="user-minus"></i>
                                <span class="sidebar-text">My Concerns</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">My Assigned Concerns</span>
                            </a>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('concerns.all-concerns') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('concerns.all-concerns') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                        <i data-feather="trello"></i>
                        <span class="sidebar-text">Concerns</span>
                        <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">View All Concerns</span>
                    </a>
                    @endif
                    @if($adminAccess)
                    <div class="accordion-group">
                        <button class="w-full flex items-center justify-between p-2 rounded-lg {{ request()->routeIs('archives.*') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                            <div class="flex items-center space-x-3">
                                <i data-feather="archive"></i>
                                <span class="sidebar-text">Archives</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Archives</span>
                            </div>
                            <i data-feather="chevron-down" class="accordion-arrow transform transition-transform duration-200"></i>
                        </button>
                        <div class="accordion-content hidden pl-2 mt-1 space-y-1 transition-all duration:300 ease-in-out">
                            <a href="{{ route('archives.reports') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('archives.reports') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="file-text"></i>
                                <span class="sidebar-text">Reports</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Archive/Reports</span>
                            </a>
                            <a href="{{ route('archives.history') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('archives.history') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="clock"></i>
                                <span class="sidebar-text">History</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Archives/History</span>
                            </a>
                            <a href="{{ route('archives.agendas') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('archives.agendas') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="book-open"></i>
                                <span class="sidebar-text">Agendas</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Archives/Agendas</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Management Section -->
                    @if($adminAccess)
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <p class="text-xs text-gray-500 px-2 mb-1 sidebar-text">MANAGEMENT</p>
                        <a href="{{ route('people') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('people') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                            <i data-feather="users"></i>
                            <span class="sidebar-text">People</span>
                            <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Users</span>
                        </a>
                    </div>
                    @endif

                    <!-- Settings Accordion -->
                    <div class="accordion-group">
                        <button class="w-full flex items-center justify-between p-2 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative transition-all duration:300 ease-in-out">
                            <div class="flex items-center space-x-3">
                                <i data-feather="settings"></i>
                                <span class="sidebar-text">Settings</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Settings</span>
                            </div>
                            <i data-feather="chevron-down" class="accordion-arrow transform transition-transform duration-200"></i>
                        </button>
                        <div class="accordion-content hidden pl-2 mt-1 space-y-1 transition-all duration:300 ease-in-out">
                            <a href="{{ route('settings.profile') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('settings.profile') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="user"></i>
                                <span class="sidebar-text">Profile</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Settings/Profile</span>
                            </a>
                            <a href="{{ route('settings.security') }}" class="flex items-center space-x-3 p-2 rounded-lg {{ request()->routeIs('settings.security') ? 'bg-blue-100 font-medium text-blue-500' :'text-gray-700 hover:bg-gray-100' }} group relative ml-8 transition-all duration:300 ease-in-out">
                                <i data-feather="lock"></i>
                                <span class="sidebar-text">Security</span>
                                <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Settings/Security</span>
                            </a>
                        </div>
                    </div>

                    <!-- Logout -->
                    
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 p-2 rounded-lg text-gray-700 hover:bg-red-200 hover:text-red-600 group relative mt-4 transition-all duration:300 ease-in-out">
                            <i data-feather="log-out"></i>
                            <span class="sidebar-text">Logout</span>
                            <span class="sidebar-tooltip hidden absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>