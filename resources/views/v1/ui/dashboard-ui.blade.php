@extends('layout.content-layout')

    @section('content-head-text', 'Dashboard Overview')
    
    @section('content-head-buttons')
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition">
            <i data-feather="plus" class="mr-2"></i> New Report
        </button>
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500">Upcoming Agenda</p>
                        <h3 class="text-2xl font-bold mt-2">80</h3>
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                                <span class="text-indigo-700 text-sm font-medium px-1"> </span>
                        </p>
                    </div>
                    <div class="p-3 rounded-lg bg-green-50 text-green-600">
                        <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500">Open Concerns</p>
                        <h3 class="text-2xl font-bold mt-2">42</h3>
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                                <span class="text-indigo-700 text-sm font-medium px-1"> </span>
                        </p>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                        <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500">Closed Concerns</p>
                        <h3 class="text-2xl font-bold mt-2">57</h3>
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                                <span class="text-indigo-700 text-sm font-medium px-1"> </span>
                        </p>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                        <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500">% Completion</p>
                        <h3 class="text-2xl font-bold mt-2">76%</h3>
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                            Out of <span class="text-indigo-700 text-sm font-medium px-1"> 143 </span> entries
                        </p>
                    </div>
                    <div class="p-3 rounded-lg bg-yellow-50 text-yellow-600">
                        <svg class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-semibold text-gray-800">Latest Agenda</h3>
                    <div class="flex space-x-2">
        
                    </div>
                </div>
                <div class="h-64 max-h-96 bg-gray-50 rounded-lg flex items-center justify-center">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Project Update Meeting</h2>
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-green-100 text-green-700 rounded-lg">Upcoming</span></p>
                                <p class="text-gray-600"><span class="font-medium">Date:</span> Nov. 15, 2025</p>
                                <p class="text-gray-600"><span class="font-medium">Attendees:</span> Jane Smith, Alice Brown, Charlie Wilson</p>
                                <p class="flex items-center text-gray-500 text-xs mt-3">
                                    <span class="mr-2 border-b-[0.25px] border-gray-500 mt-1 w-10"></span>
                                        Notes
                                    <span class="ml-2 border-b-[0.25px] border-gray-500 mt-1 w-full"></span>
                                </p>
                                <p class="text-sm text-gray-500 mt-2">Reviewed progress on Q4 deliverables. Identified blockers and reassigned tasks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-800 mb-6">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="p-2 bg-green-50 text-green-600 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="19px" viewBox="0 -960 960 960" width="19px" fill="#0ec40bff">
                                <path d="M480-360q17 0 28.5-11.5T520-400q0-17-11.5-28.5T480-440q-17 0-28.5 11.5T440-400q0 17 11.5 28.5T480-360Zm-40-160h80v-240h-80v240ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">New Concern</p>
                            <p class="text-sm text-gray-500">Open concern from John Smith</p>
                            <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg mr-3">
                            <i data-feather="users" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="font-medium">New user</p>
                            <p class="text-sm text-gray-500">Sarah Johnson registered</p>
                            <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="p-2 bg-purple-50 text-purple-600 rounded-lg mr-3">
                            <i data-feather="message-square" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="font-medium">New comment</p>
                            <p class="text-sm text-gray-500">On "Dashboard Design"</p>
                            <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-semibold text-gray-800">Recent Concerns</h3>
                <a href="#" class="text-primary text-sm font-medium">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-left text-gray-500 text-sm border-b border-gray-200">
                            <th class="pb-3">Person</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Date raised</th>
                            <th class="pb-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex items-center justify-center mr-3">
                                        <img src="http://static.photos/people/200x200/2" class="w-8 h-8 rounded-full border-2 border-white" alt="Team member">
                                    </div>
                                    <div>
                                        <p class="font-medium">Carlos Sainz</p>
                                        <p class="text-sm text-gray-500">Open Concern</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Active</span>
                            </td>
                            <td class="text-sm text-gray-500">May 15, 2025</td>
                            <td>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i data-feather="more-vertical"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex items-center justify-center mr-3">
                                        <img src="http://static.photos/people/200x200/5" class="w-8 h-8 rounded-full border-2 border-white" alt="Team member">
                                    </div>
                                    <div>
                                        <p class="font-medium">Lewis Hamilton</p>
                                        <p class="text-sm text-gray-500">Open Concern</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">Pending</span>
                            </td>
                            <td class="text-sm text-gray-500">Jun 20, 2025</td>
                            <td>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i data-feather="more-vertical"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex items-center justify-center mr-3">
                                        <img src="http://static.photos/people/200x200/8" class="w-8 h-8 rounded-full border-2 border-white" alt="Team member">
                                    </div>
                                    <div>
                                        <p class="font-medium">George Russells</p>
                                        <p class="text-sm text-gray-500">Closed Concern</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">In Review</span>
                            </td>
                            <td class="text-sm text-gray-500">Apr 30, 2025</td>
                            <td>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i data-feather="more-vertical"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection