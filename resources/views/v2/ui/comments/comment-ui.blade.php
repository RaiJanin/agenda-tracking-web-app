@extends('v2.layout.content-layout')

    @section('content-head-text', 'View Concern')

    @section('content-head-buttons')
        <button onclick="window.history.back()" class="flex items-center justify-between gap-3 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition">
            <i class="fa-solid fa-arrow-left"></i><p>Back</p>
        </button>
    @endsection

    @section('contents')
        <section class="min-h-screen overflow-hidden">
            <div class="flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 p-2 max-w-full mx-auto">
                    <div class="bg-white rounded-xl shadow border border-gray-200 p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                    
                                    <h2 class="text-2xl font-bold text-gray-900">{{$concern->responsible->name ?? 'Unknown'}}</h2>
                                </div>
                                <p class="text-base text-gray-500">{{$concern->updated_at->shortAbsoluteDiffForHumans().' ago'}}</p>
                                <p class="text-gray-600"><span class="font-medium">Agenda: </span>{{$concern->agenda->title ?? '(No agenda)'}}</p>
                                <div class="flex flex-col text-gray-700 text-lg p-2">
                                    <span class="p-2 border-b-[0.25px] border-gray-300 w-full"></span>
                                    <span class="text-gray-500 text-base">Concern:</span>
                                    <span class="font-medium py-3 mt-2 ">{{$concern->description ?? '(No description)'}}</span>
                                    <span class="p-2 border-b-[0.25px] border-gray-300 w-full"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($attachment)
                    <div class="sm:col-span-2 bg-white rounded-2xl shadow p-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-800">File Attachment</h2>
                        <div class="flex flex-col gap-4 border-t border-gray-200 pt-3">
                            <p class="text-gray-700 break-all w-64">{{ basename($attachment) }}</p>
                            @php
                                $fileUrl = asset('storage/' . $attachment);
                                $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($extension), ['jpg','jpeg','png','gif']))
                                <!-- Image preview -->
                                <img src="{{ $fileUrl }}" alt="Preview" class="w-full h-64 rounded-lg shadow">
                            @elseif (strtolower($extension) === 'pdf')
                                <!-- PDF preview -->
                                <iframe src="{{ $fileUrl }}" class="w-full h-64 border rounded-lg"></iframe>
                            @endif
                            <a href="{{ asset('storage/' . $attachment) }}"
                                target="_blank"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                View / Download
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="sm:col-span-2"></div>
                    @endif
                    <div class="sm:col-span-3 bg-white rounded-2xl p-3 border border-gray-200 shadow-md">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                            <div class="px-4">
                                <h2 class="text-xl font-semibold">Comments</h3>
                            </div>
                        </div>
                        <div class="px-5 border-b border-gray-300 mb-3 mt-3 w-full"></div>
                        <div id="comments-container" class="p-2">
                            <!-- Comments here -->
                            <div class="hidden" id="concern-id-data" data-concern-id="{{ $concern->concern_id }}"></div>
                        </div>
                        <div class="mt-5 text-xxs sm:text-sm px-4">
                            <nav id="pagination" aria-label="Pagination Navigation" class="inline-flex items-center space-x-2 text-sm font-semibold"></nav>
                            <div id="pagination-meta" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection