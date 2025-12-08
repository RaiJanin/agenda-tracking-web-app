document.addEventListener('DOMContentLoaded', function () {

    loadYourConcerns();
    function loadYourConcerns(page = 1) {
        const container = document.getElementById('myconcern-container');
        container.innerHTML = '<p>Loading data...</p>';

        handlePagination(null, null, false);

        fetch(`/concerns/your?page=${page}`, {
            headers: { "Accept": "application/json" }
        })
        .then(async response => {
            if (!response.ok) throw new Error('Failed to fetch concerns');
            const json = await response.json();

            if (!json.success) {
                throw new Error('Something went wrong while loading concerns.');
            }

            handlePagination(json.concerns, 'loadYourConcerns', true);

            container.innerHTML = json.concerns.data.map(concern => {
                let statusBadge = '';
                switch (concern.status) {
                    case 'resolved':
                        statusBadge = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-green-500 text-white rounded-lg">${concern.status}</span></p>`;
                        break;
                    case 'ongoing':
                        statusBadge = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg">${concern.status}</span></p>`;
                        break;
                    case 'closed':
                        statusBadge = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-slate-500 text-white rounded-lg">${concern.status}</span></p>`;
                        break;
                    case 'completed':
                        statusBadge = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-gray-500 text-white rounded-lg">${concern.status}</span></p>`;
                        break;
                    default:
                        statusBadge = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-amber-500 text-white rounded-lg">${concern.status}</span></p>`;
                        break;
                }

                return `
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-4">
                        <div class="h-64 max-h-96 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">${concern.agenda?.title ?? 'No Agenda'}</h2>
                                        ${statusBadge}
                                        <p class="text-gray-600 mt-2"><span class="font-medium">Description:</span> ${concern.description}</p>
                                        <p class="text-gray-600"><span class="font-medium">Responsible:</span> ${concern.responsible?.name ?? 'N/A'}</p>
                                        <p class="text-gray-600"><span class="font-medium">Due Date:</span> ${formatDate(concern.due_date)}</p>
                                        <p class="flex items-center text-gray-500 text-xs mt-8">
                                            <span class="mr-2 border-b-[0.25px] border-gray-500 mt-1 w-10"></span>
                                            Notes
                                            <span class="ml-2 border-b-[0.25px] border-gray-500 mt-1 w-full"></span>
                                        </p>
                                        <p class="text-sm text-gray-500 mt-2">${concern.comments ?? ''}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center p-3 mt-3 justify-between">
                            <div></div>
                            <div class="rounded-lg border border-gray-400">
                                <button id="view-concern-btn" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400" data-concern-id="${concern.concern_id}">View</button>
                                <button id="edit-concern-btn" class="border-r text-teal-600 border-gray-400 px-3 py-2 hover:text-teal-500" data-concern-id="${concern.concern_id}">Edit</button>
                                <button id="archive-concern-btn" class="px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500" data-concern-id="${concern.concern_id}">Archive</button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            addEventListeners();
        })
        .catch(error => {
            console.error(error);
            container.innerHTML = `<p class="text-red-600">Error loading concerns</p>`;
        });
    }

    function addEventListeners() {
        document.querySelectorAll('#view-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const id = button.getAttribute('data-concern-id');
                console.log('View concern', id);
                // Redirect or open modal
            });
        });

        document.querySelectorAll('#edit-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const id = button.getAttribute('data-concern-id');
                console.log('Edit concern', id);
                // Redirect to edit page
            });
        });

        document.querySelectorAll('#archive-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const id = button.getAttribute('data-concern-id');
                console.log('Archive concern', id);
                // Call archive API
            });
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return 'N/A';
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }

    window.loadYourConcerns = loadYourConcerns;
});
