import { dateToString } from "../components/dateString.js";
import { deleteConcern } from "../rest-api/deleteConcern.js";
import { timeAgo } from "../components/timeAgo.js";


document.addEventListener('DOMContentLoaded', function () {
    const concernContainer = document.getElementById('concerns-container');
    const agendaIdData = document.getElementById('agenda-id-data').dataset.agendaId;

    indexR();
    function indexR(page = 1) {

        concernContainer.innerHTML = '<p class="text-md p-4 ml-7 text-gray-400">Loading...</p>';
        handlePagination(null, null, false);

        fetch(`/${agendaIdData}/concernBAg?page=${page}`, {
            method: 'GET',
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Accept": "application/json"
            }
        }).
        then(async response => {
            const data = await response.json();

            if(!data.success) {
                alert('Something went wrong. Please try again later');
                return;
            }

            if(data.concerns.data.length === 0) {
                concernContainer.innerHTML = `
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">No Concerns Under this Agenda</h3>
                    </div>
                </div>
                `;
                return;
            }

            handlePagination(data.concerns, 'indexR', true);

            concernContainer.innerHTML = data.concerns.data.map(concern => {
                let editArchAccess = '';
                let concernStatus = '';
                let commentCount = '';

                if(data.roles.admin || data.roles.me === concern.responsible_person_id) {
                    editArchAccess = `
                    <div class="text-base font-medium rounded-lg border border-gray-400">
                        <button data-concern-id="${concern.concern_id}" class="view-concern-btn text-sm border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400">View</button>
                        <button data-concern-id="${concern.concern_id}" class="edit-concern-btn text-sm px-3 text-teal-600 py-2 rounded-r-lg hover:text-teal-500">Edit</button>
                        <button data-concern-id="${concern.concern_id}" class="delete-concern-btn bg-red-500 text-white px-3 py-2 rounded-r-md text-sm hover:bg-red-600">Delete</button>
                    </div>
                    `;
                } else {
                    editArchAccess = `
                    <div class="text-base font-medium rounded-lg border border-gray-400">
                        <button type="button" onclick='window.location.href="#"' class="text-sm text-slate-500 px-3 py-2 rounded-l-lg hover:text-slate-400">View</button>
                    </div>
                    `;
                }

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

                return `
                <div class="concern-item bg-gray-50 border border-gray-200 rounded-lg p-2 shadow-sm mb-2">
                    <div class="flex flex-col gap-2 p-2">
                        <div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                <h2 class="text-lg font-bold text-gray-900">${concern.responsible?.name ?? 'Unknown'}</h2>
                            </div>
                            <p class="text-sm text-gray-500">${timeAgo(concern.updated_at)}</p>
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
                        <div class="flex items-center justify-start">
                            ${editArchAccess}
                        </div>
                    </div>
                </div>
                `;
            }).join('');

            addEventListeners();
        }).
        catch (error => {
            console.error(error);
        });
    }

    function addEventListeners() {
        document.querySelectorAll('.view-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `../../app/concerns/${concernId}/comments`;
            });
        });

        document.querySelectorAll('.edit-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                window.location.href = `/app/concerns/${concernId}/edit`;
            });
        });

        document.querySelectorAll('.delete-concern-btn').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const concernId = button.getAttribute('data-concern-id');
                if(!confirm('Are you sure you want to delete this concern?')) return;
                console.log(concernId);
                deleteConcern(concernId);
                indexR();
            });
        });
    }

    window.indexR = indexR;
    
});


