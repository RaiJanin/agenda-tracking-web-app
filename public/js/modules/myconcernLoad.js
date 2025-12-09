import { timeAgo } from "../components/timeAgo.js";
import { dateToString } from "../components/dateString.js";
import { archivedConcern } from "../rest-api/archiveConcern.js";

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
                let commentCount = '';

                switch (concern.status) {
                    case 'resolved':
                        statusBadge = `<span class="px-2 py-1 text-sm bg-green-500 text-white rounded-lg">${concern.status}</span>`;
                        break;
                    case 'ongoing':
                        statusBadge = `<span class="px-2 py-1 text-sm bg-blue-500 text-white rounded-lg">${concern.status}</span>`;
                        break;
                    case 'closed':
                        statusBadge = `<span class="px-2 py-1 text-sm bg-slate-500 text-white rounded-lg">${concern.status}</span>`;
                        break;
                    case 'completed':
                        statusBadge = `<span class="px-2 py-1 text-sm bg-gray-500 text-white rounded-lg">${concern.status}</span>`;
                        break;
                    default: // pending
                        statusBadge = `<span class="px-2 py-1 text-sm bg-amber-500 text-white rounded-lg">${concern.status}</span>`;
                        break;
                }

                commentCount = concern.comment_list_count >= 100 ? `99+` : concern.comment_list_count;

                return `
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-4">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                            <div class="p-3 min-w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                            <h2 class="text-lg font-bold text-gray-900">${concern.responsible?.name ?? 'Unknown'}</h2>
                                        </div>
                                        <p class="text-sm text-gray-500">${timeAgo(concern.created_at)}</p>
                                        <p class="text-gray-600"><span class="font-medium">Agenda: </span>${concern.agenda?.title ?? '(No agenda)'}</p>
                                        <p class="text-gray-600"><span class="font-medium">Due Date:</span> ${dateToString('longDate', concern.due_date)}</p>
                                        <div class="flex flex-col bg-white text-gray-500 text-md p-2 rounded-lg border border-gray-200 shadow mt-4">
                                            <span class="font-medium">${concern.description ?? '(No description)'}</span>
                                            <span class="p-2 border-b-[0.25px] border-gray-300 w-full"></span>
                                            <div class="flex items-center gap-2 mt-2 mb-2">
                                                ${statusBadge}
                                                <span class="px-2 py-1 text-sm text-gray-600 rounded-lg">Comments: <span class="rounded-full bg-red-500 text-white px-1">${commentCount}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center mt-3 justify-between">
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
                const concernid = button.getAttribute('data-concern-id');
                if(!confirm('Are you sure you want to archive this concern?')) return;
                archivedConcern(concernid);
                loadYourConcerns();
            });
        });
    }

    window.loadYourConcerns = loadYourConcerns;
});
