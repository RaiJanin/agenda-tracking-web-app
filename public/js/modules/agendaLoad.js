document.addEventListener('DOMContentLoaded', function () {
    function indexR() {
        const agendaContainer = document.getElementById('agenda-container');

        agendaContainer.innerHTML = '';

        fetch('/agenda-load', {
            method: 'GET',
            headers: {"Accept" : "application/json"}
        })
        .then(async response => {
            const text = await response.text();
            try {
                const data = JSON.parse(text);

                if(!data.success) {
                    alert('Something went wrong. Please try again later');
                    return;
                }

                agendaContainer.innerHTML = data.agendas.map(agenda => {
                    let agendaStatus = '';

                    switch(agenda.status) {
                        case 'resolved':
                            agendaStatus = `
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-green-500 text-white rounded-lg">${agenda.status}</span></p>
                                `;
                            break;
                        case 'ongoing':
                            agendaStatus = `
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg">${agenda.status}</span></p>
                                `;
                            break;
                        case 'closed':
                            agendaStatus = `
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-slate-500 text-white rounded-lg">${agenda.status}</span></p>
                                `;
                            break;
                        case 'completed':
                            agendaStatus = `
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-gray-500 text-white rounded-lg">${agenda.status}</span></p>
                                `;
                            break;
                        default: //pending
                            agendaStatus = `
                                <p class="mt-2 mb-2"><span class="px-4 py-2 text-sm bg-amber-500 text-white rounded-lg">${agenda.status}</span></p>
                                `;
                            break;
                    }

                    return `
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="h-64 max-h-96 bg-gray-50 border border-gray-200 rounded-lg flex items-center justify-center">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-xl font-bold text-gray-900">${agenda.title}</h2>
                                            ${agendaStatus}
                                            <p class="text-gray-600"><span class="font-medium">Date:</span> ${formatDate(agenda.date)}</p>
                                            <!-- <p class="text-gray-600"><span class="font-medium">Attendees:</span> Jane Smith, Alice Brown, Charlie Wilson</p> -->
                                            <p class="flex items-center text-gray-500 text-xs mt-8">
                                                <span class="mr-2 border-b-[0.25px] border-gray-500 mt-1 w-10"></span>
                                                    Notes
                                                <span class="ml-2 border-b-[0.25px] border-gray-500 mt-1 w-full"></span>
                                            </p>
                                            <p class="text-sm text-gray-500 mt-2">${agenda.notes}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center p-3 mt-3 justify-between">
                                <div></div>
                                <div class="rounded-lg border border-gray-400">
                                    <button id="view-ag-btn" class="border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400" data-agenda-id="${agenda.agenda_id}">View</button>
                                    <button id="edit-ag-btn" class="border-r text-teal-600 border-gray-400 px-3 py-2 hover:text-teal-500" data-agenda-id="${agenda.agenda_id}">Edit</button>
                                    <button id="archive-ag-btn" class="px-3 text-red-600 py-2 rounded-r-lg hover:text-red-500" data-agenda-id="${agenda.agenda_id}">Archive</button>
                                </div>
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

        document.querySelectorAll('#archive-ag-btn').forEach(button => {
            button.addEventListener('click', async function (e) {
                e.preventDefault();
                const agendaId = this.getAttribute('data-agenda-id');
                
                if(!confirm('Are you sure you want to archive this agenda?')) return;

                try {
                    const response = await fetch(`/agendas/${agendaId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept' : 'application/json'
                        }
                    });

                    const result = await response.json();
                    console.log(result);

                    if(!result.success) {
                        alert(result.message);
                        return;
                    }

                    alert('Agenda archived successfully.');
                    indexR(); ///reload agendas container

                    console.log(result);
                } catch (err) {
                    console.error(err);
                    alert('Internal Server Error');
                }
             });
        });
    }

    function formatDate(dateStr) {
        if (!dateStr) return null; 
        let date = new Date(dateStr);
        let options = {year: 'numeric', month: 'long', day: 'numeric'};
        let formatted = date.toLocaleDateString('en-US', options);
        return `${formatted}`;
    }

    window.indexR = indexR;
    indexR();
    
});