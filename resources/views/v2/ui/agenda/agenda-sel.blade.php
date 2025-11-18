            <div class="flex-1 overflow-y-auto">
                <div class="p-8 max-w-5xl mx-auto">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $agenda->title }}</h1>
                            <p class="text-gray-600 text-sm mt-1">
                                Date: <span class="font-medium">{{ \Carbon\Carbon::parse($agenda->date)->format('F d, Y') }}</span> <br>
                                Created by: <span class="font-medium">{{ $agenda->user->name ?? 'N/A' }}</span>
                            </p>
                        </div>

                        <a href="{{ route('agenda.view-all') }}"
                            class="bg-amber-500 text-black px-4 py-2 rounded-lg hover:bg-amber-600 transition">
                            ← Back to List
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-800">Agenda Details</h2>
                        <div class="border-t border-gray-200 mt-2 pt-3 text-gray-700">
                            <p class="mb-2"><strong>Title:</strong> {{ $agenda->title }}</p>
                            <p class="mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($agenda->date)->toFormattedDateString() }}</p>
                            <p class="mb-2"><strong>Status:</strong>
                                <span class="px-2 py-1 rounded text-sm
                                    @if($agenda->status === 'resolved') px-4 py-2 text-sm bg-green-500 text-white rounded-lg
                                    @elseif($agenda->status === 'ongoing') px-4 py-2 text-sm bg-blue-500 text-white rounded-lg
                                    @elseif($agenda->status === 'closed') px-4 py-2 text-sm bg-slate-500 text-white rounded-lg
                                    @elseif($agenda->status === 'completed') px-4 py-2 text-sm bg-gray-500 text-white rounded-lg
                                    @else px-4 py-2 text-sm bg-amber-500 text-white rounded-lg
                                    @endif">
                                    {{ ucfirst($agenda->status) }}
                                </span>
                            </p>
                            <p class="mb-4"><strong>Notes:</strong></p>
                            <p class="bg-gray-50 p-3 rounded-lg border border-gray-200 whitespace-pre-line">
                                {{ $agenda->notes ?: 'No notes available.' }}
                            </p>
                        </div>
                    </div>

                    @if($agenda->file_path)
                        <div class="bg-white rounded-2xl shadow p-6 mb-6">
                            <h2 class="text-xl font-semibold mb-3 text-gray-800">File Attachment</h2>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                <p class="text-gray-700">{{ basename($agenda->file_path) }}</p>
                                <a href="{{ asset('storage/' . $agenda->file_path) }}"
                                    target="_blank"
                                    class="text-blue-600 hover:text-blue-800 font-medium">
                                    View / Download
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(auth()->id() === $agenda->created_by)
                        <div class="flex items-center p-3 mt-3 justify-between">
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
                                    }
                                </script>
                            </div>
                        </div>
                    @endif
                </div>
            </div>