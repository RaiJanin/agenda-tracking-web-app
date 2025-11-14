@extends('v2.layout.content-layout')

    @section('content-head-text', 'Users Management')

    @section('content-head-buttons')
        <button onclick="window.location.href=`#`" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition">
            <i data-feather="plus" class="mr-2"></i>Add User
        </button>
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 overflow-y-auto p-2">
            <div class="col-span-2">
                <div class="flex items-center border border-gray-400 rounded-lg shadow-md bg-white p-2 mb-5">
                    <div class="bg-gray-50 border border-gray-300 py-1 px-3 rounded-md">
                        <i class="fa-solid fa-magnifying-glass text-gray-500 text-xl"></i>
                        <input type="text" placeholder="Search Users" class="border-0 bg-gray-50 p-1 focus:outline-none focus:ring-0 max-w-96 min-w-60">
                    </div>
                </div>
            </div>
            <div class="col-span-3">
                <div id="user-container" class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    
                </div>
            </div>
        </div>
    @endsection