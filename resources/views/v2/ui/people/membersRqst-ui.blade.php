@extends('v2.layout.content-layout')

    @section('content-head-text', 'Membership Requests')

    @section('content-head-buttons')
        <button onclick="window.location.href=`{{ route('people') }}`" class="flex items-center justify-between gap-3 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition">
            <i class="fa-solid fa-arrow-left"></i><p>Back</p>
        </button>
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 overflow-y-auto p-2">
            <div class="sm:col-span-2 col-span-3">
                <div class="flex flex-col border border-gray-400 rounded-lg shadow-md bg-white mb-2">
                    <div class="p-3 flex justify-between">
                        <h2 class="text-xl font-semibold">Membership requests <span class="text-blue-500">12</span></h2>
                    </div>
                    <div class="px-8 py-2 mb-2 max-h-80 overflow-auto">
                        <div class="flex flex-col gap-2">
                            @forelse($member_requests as $member_req)
                            <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                                <p class="text-lg text-gray-800 font-medium">{{  $member_req->name }}</p>
                                <p class="ml-4 text-base text-gray-600">{{ __('Feature coming soon') }}</p>
                                <div class="flex flex-row gap-2 mt-3">
                                    <button class="rounded-lg bg-blue-500 text-white font-medium text-sm py-2 px-8 hover:bg-blue-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">View</button>
                                    <button class="rounded-lg bg-gray-400 text-white font-medium text-sm py-2 px-8 hover:bg-gray-500 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all duration-300">Delete</button>
                                </div>
                            </div>
                            @empty
                            <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                                <p class="text-lg text-gray-800 font-medium">{{ __('No requests yet') }}</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection