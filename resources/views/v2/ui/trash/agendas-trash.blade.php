@extends('v2.layout.content-layout')

    @section('content-head-text', 'Trashed Agendas')

    @section('content-head-buttons')
        
    @endsection

    @section('contents')
    <div class="flex-1 overflow-y-auto bg-gray-50 min-h-screen">
        <div class="mx-auto p-3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Created By</th>
                            <th class="px-6 py-3 text-center"></th>
                        </tr>
                    </thead>

                    <tbody id="trashAgenda-data" class="divide-y divide-gray-100 text-sm text-gray-800">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection