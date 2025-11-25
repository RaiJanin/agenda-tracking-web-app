            <div class="flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 p-2 max-w-full mx-auto">
                    <div class="sm:col-span-3 p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-4 flex-col">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $agenda->title }}</h1>
                                <div class="text-lg flex flex-col gap-2 mt-1">
                                    <p class="text-gray-600">Date: <span class="font-medium">{{ \Carbon\Carbon::parse($agenda->date)->format('F d, Y') }}</span></p>
                                    <p class="text-gray-600">Created by: <span class="font-medium">{{ $agenda->user->name ?? 'N/A' }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2 bg-white rounded-2xl shadow p-6 min-h-80 max-h-4xl">
                        <h2 class="text-xl font-semibold mb-3 text-gray-800">Agenda Details</h2>
                        <div class="border-t border-gray-200 mt-2 pt-3 text-gray-700">
                            <p class="mt-2 mb-2"><strong>Status:</strong>
                                <span class="px-2 py-1 rounded text-sm ml-4
                                    @if($agenda->status === 'resolved') px-4 py-2 text-sm bg-green-500 text-white rounded-lg
                                    @elseif($agenda->status === 'ongoing') px-4 py-2 text-sm bg-blue-500 text-white rounded-lg
                                    @elseif($agenda->status === 'closed') px-4 py-2 text-sm bg-slate-500 text-white rounded-lg
                                    @elseif($agenda->status === 'completed') px-4 py-2 text-sm bg-gray-500 text-white rounded-lg
                                    @else px-4 py-2 text-sm bg-amber-500 text-white rounded-lg
                                    @endif">
                                    {{ ucfirst($agenda->status) }}
                                </span>
                            </p>
                            <div class="flex flex-col gap-4 bg-gray-50 p-3 rounded-lg border border-gray-200 mt-8">
                                <div class="flex items-center text-gray-500 text-sm">
                                    <span class="mr-2 border-b-[0.25px] border-gray-300 mt-1 w-10"></span>
                                        Notes
                                    <span class="ml-2 border-b-[0.25px] border-gray-300 mt-1 w-full"></span>
                                </div>
                                <span class="text-base text-gray-700">{{ $agenda->notes ?: 'No notes available.' }}</span>
                            </div>
                            @if(auth()->id() === $agenda->created_by)
                                <div class="flex items-center p-3 justify-between mt-3">
                                    <div></div>
                                    <div class="text-base font-medium rounded-lg border border-gray-400">
                                        <button type="button" onclick="window.location.href=`{{ route('agenda.edit-prev', $agenda->agenda_id) }}`" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400">Edit</button>
                                        <button 
                                            onclick="isConfirm({{ $agenda->agenda_id }})" 
                                            class="px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500">
                                                Archive
                                        </button>
                                        <script>
                                            function isConfirm(agendaId) {
                                                if(!confirm('Are you sure you want to archive this agenda?')) return;
                                                archivedAgenda(agendaId);
                                                window.location.href = `/app/view-agenda`;
                                            }
                                        </script>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($attachment)
                        <div class="bg-white rounded-2xl shadow p-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800">File Attachment</h2>
                            <div class="flex flex-col gap-4 border-t border-gray-200 pt-3">
                                <p class="text-gray-700 break-all w-64">{{ basename($attachment->file_path) }}</p>
                                @php
                                    $fileUrl = asset('storage/' . $attachment->file_path);
                                    $extension = pathinfo($attachment->file_path, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array(strtolower($extension), ['jpg','jpeg','png','gif']))
                                    <!-- Image preview -->
                                    <!-- <img src="{{ $fileUrl }}" alt="Preview" class="w-64 h-64 rounded-lg shadow"> -->
                                @elseif (strtolower($extension) === 'pdf')
                                    <!-- PDF preview -->
                                    <!-- <iframe src="{{ $fileUrl }}" class="w-full h-64 border rounded-lg"></iframe> -->
                                @endif
                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    View / Download
                                </a>
                            </div>
                        </div>
                    @else
                        <div></div>
                    @endif
                    <div class="sm:col-span-3 bg-white rounded-2xl p-3 border border-gray-200 shadow-md">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                            <h2 class="p-2 mt-2 ml-2 text-xl font-semibold">Concerns</h2>
                            {{-- ✅ Only Admin or Member can add new concerns --}}
                            @if(in_array(auth()->user()->role, ['admin', 'member']))
                                <button type="button" onclick="window.location.href=`{{ route('concerns.create-preview', $agenda->agenda_id) }}`"
                                    class="text-sm bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition ml-3">
                                    + Add Concern
                                </button>
                            @endif
                        </div>
                        <div class="px-5 border-b border-gray-300 mb-3 mt-3 w-full"></div>
                        @if($agenda->concerns->isNotEmpty())
                            @foreach($agenda->concerns as $concern)
                                <div class="concern-item bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm mb-2">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800">{{ $concern->description }}</h3>
                                            <p class="text-gray-600 mt-1">Due date: {{ $concern->due_date ? \Carbon\Carbon::parse($concern->due_date)->format('M d, Y') : '-' }}</p>
                                            <p class="text-sm text-gray-500 mt-1">Raised by: {{ $concern->responsible->name }}</p>
                                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded">{{ ucfirst($concern->status) }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="toggle-status bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">Mark Done</button>
                                            <button class="edit-item bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Edit</button>
                                            <button class="delete-item bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">No Concerns Under this Agenda</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>