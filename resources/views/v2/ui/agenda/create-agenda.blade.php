@extends('v2.layout.content-layout')

    @section('content-head-text', 'Create Agenda')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 overflow-y-auto">
            <div class="p-3 col-span-2">
                @if(session('success'))
                    <div class="flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mt-5 mb-4">
                        {{ session('success') }}<span class="underline hover:text-green-500"><i class="fa-solid fa-arrow-left text-xs ml-5"></i><a href="{{ route('agenda.view-all') }}">See list</a></span>
                    </div>
                @endif
                @if ($errors->any())
                    @include('v2.components.warnings.error-all')
                @endif
                <form action="{{ route('agendas.store') }}" method="POST" enctype="multipart/form-data" 
                    class="max-w-5xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-gray-200">
                    @csrf

                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Add New Agenda</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" required
                                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" name="date" required
                                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800">
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea name="notes" rows="4"
                                class="w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500 text-gray-800"></textarea>
                        </div>

                        <!-- File -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">File Attachment</label>
                            <input type="file" name="file_path"
                                class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer 
                                focus:outline-none 
                                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-400 file:text-slate-700
                                hover:file:bg-gray-300 transition-all duration-400"/>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="mt-6 flex justify-end gap-2">
                        <button type="button" onclick="window.location.href=`{{ route('agenda.view-all') }}`"
                            class="px-3 py-1.5 text-red-500 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-red-400 hover:shadow-md hover:border-red-500 focus:ring-2 focus:ring-red-500 focus:ring-offset-1 transition-all duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-3 py-1.5 text-teal-800 font-medium rounded-lg shadow-sm border border-gray-400 hover:text-teal-600 hover:shadow-md hover:border-teal-500 focus:ring-2 focus:ring-teal-400 focus:ring-offset-1 transition-all duration-300">
                            Save Agenda
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endsection