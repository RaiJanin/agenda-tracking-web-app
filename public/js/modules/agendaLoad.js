import { deleteAgenda } from "../services/deleteAgenda.js";
import { dateToString } from "../utilities/dateString.js";
import { showConfirmationModal } from "../components/cfFire.js";

document.addEventListener('DOMContentLoaded', function () {
    indexR();
    function indexR(page = 1) {
        
        const agendaContainer = document.getElementById('agenda-container');

        agendaContainer.innerHTML = '<p>Loading data...</p>';
        handlePagination(null, null, false);

        fetch(`/agenda-load?page=${page}`, {
            method: 'GET',
            headers: {"Accept" : "application/json"}
        })
        .then(async response => {
            const text = await response.text();
            try {
                const data = JSON.parse(text);

                if(!data.success) {
                    showNotification('Something went wrong. Please try again later', 'error');
                    return;
                }

                if(data.agendas.data.length == 0) {
                    agendaContainer.innerHTML = `
                        <div class="flex items-center justify-center p-6">
                            <h3 class="text-lg text-gray-600">No agendas yet</h3>
                        </div>
                    `;
                    return;
                }

                handlePagination(data.agendas, 'indexR', true);

                agendaContainer.innerHTML = data.agendas.data.map(agenda => {
                    let agendaStatus = '';
                    let actionBtns = '';
                    let concernsCount = '';
                    let notes = '';

                    switch(agenda.status) {
                        case 'resolved':
                            agendaStatus = `
                                <span class="px-2 py-1 text-sm bg-green-500 text-white rounded-lg">${agenda.status}</span>
                                `;
                            break;
                        case 'ongoing':
                            agendaStatus = `
                                <span class="px-2 py-1 text-sm bg-blue-500 text-white rounded-lg">${agenda.status}</span>
                                `;
                            break;
                        case 'closed':
                            agendaStatus = `
                                <span class="px-2 py-1 text-sm bg-slate-500 text-white rounded-lg">${agenda.status}</span>
                                `;
                            break;
                        case 'completed':
                            agendaStatus = `
                                <span class="px-2 py-1 text-sm bg-gray-500 text-white rounded-lg">${agenda.status}</span>
                                `;
                            break;
                        default: //pending
                            agendaStatus = `
                                <span class="px-2 py-1 text-sm bg-amber-500 text-white rounded-lg">${agenda.status}</span>
                                `;
                            break;
                    }

                    if(adminAccess) {
                        actionBtns = `
                            <div class="rounded-lg border border-gray-400">
                                <button id="view-ag-btn" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400" data-agenda-id="${agenda.agenda_id}">View</button>
                                <button id="edit-ag-btn" class="border-r text-teal-600 border-gray-400 px-3 py-2 hover:text-teal-500" data-agenda-id="${agenda.agenda_id}">Edit</button>
                                <button class="delete-ag-btn px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500" data-agenda-id="${agenda.agenda_id}">Delete</button>
                            </div>
                        `;
                    } else {
                        actionBtns = `
                            <div class="rounded-lg border border-gray-400">
                                <button id="view-ag-btn" class="text-slate-500 px-4 py-2 hover:text-slate-400" data-agenda-id="${agenda.agenda_id}">View</button>
                            </div>
                        `;
                    }

                    concernsCount = agenda.concerns_count >= 100 ? `99+` : agenda.concerns_count;

                    if (agenda.notes) {
                        notes = `<span class="font-medium">${agenda.notes}</span>`;
                    } else {
                        notes = `<span class="font-small text-gray-400">No notes yet</span>`;
                    }

                    return `
                        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                                <div class="p-3 min-w-full">
                                    <div class="flex flex-col w-full">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
                                            <h2 class="text-xl font-bold text-gray-900">${agenda.title}</h2>
                                        </div>
                                        <p class="text-gray-600"><span class="font-medium">Due Date:</span> ${dateToString('longDate', agenda.date)}</p>
                                        <div class="flex flex-col bg-white text-gray-500 text-md p-2 rounded-lg border border-gray-200 shadow mt-4">
                                            <p class="flex items-center text-gray-500 text-xs mt-1 mb-2">Notes:</p>
                                            ${notes}
                                            <span class="p-2 border-b-[0.25px] border-gray-300 w-full"></span>
                                            <div class="flex items-center gap-2 mt-2 mb-2">
                                                ${agendaStatus}
                                                <span class="px-2 py-1 text-sm text-gray-600 rounded-lg">Concerns: <span class="rounded-full bg-red-500 text-white px-2">${concernsCount}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center mt-3 justify-between">
                                <div></div>
                                ${actionBtns}
                            </div>
                        </div>
                    `
                }).join('');

                eventListeners();
            } catch (error) {
                alert('Internal Server Error');
                console.error(error);
            }
        });
    }

    function eventListeners() {
        document.querySelectorAll('#view-ag-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const agendaId = this.getAttribute('data-agenda-id');
                window.location.href = "/app/view-agenda/"+agendaId;
            });
        });

        document.querySelectorAll('#edit-ag-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const agendaId = this.getAttribute('data-agenda-id');
                window.location.href = "/app/edit-agenda/"+agendaId;
            });
        });

        document.querySelectorAll('.delete-ag-btn').forEach(button => {
            button.addEventListener('click', async function (e) {
                const btn = e.target.closest('.delete-ag-btn');
                if(!btn) return;

                e.preventDefault();
                const agendaId = this.getAttribute('data-agenda-id');
                
                const isConfirmed = await showConfirmationModal('Confirm Delete?', 'Are you sure you want to delete this agenda?');
                if (!isConfirmed) return;

                deleteAgenda(agendaId);
                indexR();
             });
        });
    }

    window.indexR = indexR;
    
});