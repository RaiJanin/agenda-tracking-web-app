import { deleteConcern } from "../services/deleteConcern.js";
import { timeAgo } from "../utilities/timeAgo.js";
import { dateToString } from "../utilities/dateString.js";
import { showConfirmationModal } from "../components/cfFire.js";


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
                    showNotification('Something went wrong. Please try again later', 'error');
                    return;
                }

                if(json.concerns.data.length == 0) {
                    concernContainer.innerHTML = `
                    <div class="flex items-center justify-center p-6">
                        <h3 class="text-lg text-gray-600">No concerns yet</h3>
                    </div>
                    `;
                    return;
                }

                handlePagination(json.concerns, 'indexR', true);

                concernContainer.innerHTML = json.concerns.data.map(concern => {
                    let concernStatus = '';
                    let actionBTns = '';
                    let commentCount = '';

                    switch (concern.status) {
                        case 'resolved':
                            concernStatus = `<span class="px-2 py-1 text-sm bg-green-500 text-white rounded-lg">${concern.status}</span>`;
                            break;
                        case 'ongoing':
                            concernStatus = `<span class="px-2 py-1 text-sm bg-blue-500 text-white rounded-lg">${concern.status}</span>`;
                            break;
                        case 'closed':
                            concernStatus = `<span class="px-2 py-1 text-sm bg-slate-500 text-white rounded-lg">${concern.status}</span>`;
                            break;
                        case 'completed':
                            concernStatus = `<span class="px-2 py-1 text-sm bg-gray-500 text-white rounded-lg">${concern.status}</span>`;
                            break;
                        default: // pending
                            concernStatus = `<span class="px-2 py-1 text-sm bg-amber-500 text-white rounded-lg">${concern.status}</span>`;
                            break;
                    }
                   
                    commentCount = concern.comment_list_count >= 100 ? `99+` : concern.comment_list_count;

                    if(admiNAccess) {
                        actionBTns = `
                        <div class="rounded-lg border border-gray-400">
                            <button id="view-concern-btn" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400" data-concern-id="${concern.concern_id}">View</button>
                            <button id="edit-concern-btn" class="border-r text-teal-600 border-gray-400 px-3 py-2 hover:text-teal-500" data-concern-id="${concern.concern_id}">Edit</button>
                            <button class="delete-concern-btn px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500" data-concern-id="${concern.concern_id}">Delete</button>
                        </div>
                        `;
                    } else {
                        actionBTns = `
                        <div class="rounded-lg border border-gray-400">
                            <button id="view-concern-btn" class="text-slate-500 px-3 py-2 rounded-l-lg hover:text-slate-400" data-concern-id="${concern.concern_id}">View</button>
                        </div>
                        `;
                    }

                    return `
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 mb-4">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                                <div class="p-3 min-w-full">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                                <h2 class="text-lg font-bold text-gray-900">${concern.responsible?.name ?? 'Unknown'}</h2>
                                            </div>
                                            <p class="text-sm text-gray-500">${timeAgo(concern.updated_at)}</p>
                                            <p class="text-gray-600"><span class="font-medium">Agenda: </span>${concern.agenda?.title ?? '(No agenda)'}</p>
                                            <p class="text-gray-600"><span class="font-medium">Due Date:</span> ${dateToString('longDate', concern.due_date)}</p>
                                            <div class="flex flex-col bg-white text-gray-500 text-md p-2 rounded-lg border border-gray-200 shadow mt-4">
                                                <span class="font-medium">${concern.description ?? '(No description)'}</span>
                                                <span class="p-2 border-b-[0.25px] border-gray-300 w-full"></span>
                                                <div class="flex items-center gap-2 mt-2 mb-2">
                                                    ${concernStatus}
                                                    <span class="px-2 py-1 text-sm text-gray-600 rounded-lg">Comments: <span class="rounded-full bg-red-500 text-white px-2">${commentCount}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mt-3 justify-between">
                                <div></div>
                                ${actionBTns}
                            </div>
                        </div>
                    `;
                }).join('');

                addEventListeners();
            } catch (error) {
                showNotification('Internal server error', 'error');
                console.error(error);
            }
        });
    }

    function addEventListeners() {
        document.querySelectorAll('#view-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `../../app/concerns/${concernId}/comments`;
            });
        });

        document.querySelectorAll('#edit-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `/app/concerns/${concernId}/edit`;
            });
        });

        document.querySelectorAll('.delete-concern-btn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                const isConfirmed = await showConfirmationModal('Confirm Delete?', 'Are you sure you want to delete this concern?');
                if (!isConfirmed) return;
                deleteConcern(concernId);
                indexR();
            });
        });
    }

    window.indexR = indexR;
    
});
