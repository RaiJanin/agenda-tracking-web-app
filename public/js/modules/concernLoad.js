document.addEventListener('DOMContentLoaded', function () {

    indexR();
    function indexR(page = 1) {
        const concernContainer = document.getElementById('concern-container');
        concernContainer.innerHTML = '<p>Loading data...</p>';

        handlePagination(null, null, false);

        fetch(`/concerns/all?page=${page}`, {
            method: 'GET',
            headers: { "Accept": "application/json" }
        })
        .then(async response => {
            const text = await response.text();
            try {
                const json = JSON.parse(text);

                if (!json.success) {
                    alert('Something went wrong. Please try again later');
                    return;
                }

                handlePagination(json.concerns, 'indexR', true);

                concernContainer.innerHTML = json.concerns.data.map(concern => {
                    let concernStatus = '';
                    switch (concern.status) {
                        case 'resolved':
                            concernStatus = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-green-500 text-white rounded-lg">${concern.status}</span></p>`;
                            break;
                        case 'ongoing':
                            concernStatus = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg">${concern.status}</span></p>`;
                            break;
                        case 'closed':
                            concernStatus = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-slate-500 text-white rounded-lg">${concern.status}</span></p>`;
                            break;
                        case 'completed':
                            concernStatus = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-gray-500 text-white rounded-lg">${concern.status}</span></p>`;
                            break;
                        default: // pending
                            concernStatus = `<p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-amber-500 text-white rounded-lg">${concern.status}</span></p>`;
                            break;
                    }

                    return `
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-4">
                            <div class="h-64 max-h-96 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-xl font-bold text-gray-900">${concern.agenda?.title ?? '(No agenda)'}</h2>
                                            ${concernStatus}
                                            <p class="text-gray-600 mt-2"><span class="font-medium">Responsible:</span> ${concern.responsible?.name ?? 'Unknown'}</p>
                                            <p class="text-gray-600 mt-1"><span class="font-medium">Due Date:</span> ${formatDate(concern.due_date)}</p>
                                            <p class="flex items-center text-gray-500 text-xs mt-8">
                                                <span class="mr-2 border-b-[0.25px] border-gray-500 mt-1 w-10"></span>
                                                    Description
                                                <span class="ml-2 border-b-[0.25px] border-gray-500 mt-1 w-full"></span>
                                            </p>
                                            <p class="text-sm text-gray-500 mt-2">${concern.description ?? '(No description)'}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center p-3 mt-3 justify-end rounded-lg border border-gray-400">
                                <button id="view-concern-btn" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400" data-concern-id="${concern.concern_id}">View</button>
                                <button id="edit-concern-btn" class="border-r text-teal-600 border-gray-400 px-3 py-2 hover:text-teal-500" data-concern-id="${concern.concern_id}">Edit</button>
                                <button id="archive-concern-btn" class="px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500" data-concern-id="${concern.concern_id}">Archive</button>
                            </div>
                        </div>
                    `;
                }).join('');

                addEventListeners();
            } catch (error) {
                alert('Internal Server Error');
                console.error(error);
            }
        });
    }

    function addEventListeners() {
        document.querySelectorAll('#view-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `/concerns/show/${concernId}`;
            });
        });

        document.querySelectorAll('#edit-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `/app/concerns/${concernId}/edit`;
            });
        });

        document.querySelectorAll('#archive-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                console.log('Archive concern', concernId);
                // You can implement your archive API later
            });
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return 'N/A';
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }

    window.indexR = indexR;
    
});
