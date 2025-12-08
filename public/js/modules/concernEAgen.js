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

                if(data.roles.admin || data.roles.me === concern.responsible_person_id) {
                    editArchAccess = `
                    <div class="text-base font-medium rounded-lg border border-gray-400">
                        <button type="button" onclick='window.location.href="#"' class="text-sm border-r text-slate-500 border-gray-400 px-3 py-2 rounded-l-lg hover:text-slate-400">View</button>
                        <button onclick='window.location.href="#"' class="text-sm px-3 text-teal-600 py-2 rounded-r-lg hover:text-teal-500">Edit</button>
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-2 rounded-r-md text-sm hover:bg-red-600"
                                onclick="return confirm('Delete this concern?')">
                            Delete
                        </button>
                    </div>
                    `;
                } else {
                    editArchAccess = `
                    <div class="text-base font-medium rounded-lg border border-gray-400">
                        <button type="button" onclick='window.location.href="#"' class="text-sm text-slate-500 px-3 py-2 rounded-l-lg hover:text-slate-400">View</button>
                    </div>
                    `;
                }
                return `
                <div class="concern-item bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm mb-2">
                    <div class="flex flex-col gap-5 p-2">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">${concern.description}</h3>
                            <p class="text-gray-600 mt-1">Due date: ${concern.due_date}</p>
                            <p class="text-sm text-gray-500 mt-1">Responsible Person: ${concern.responsible.name}</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs font-medium bg-amber-500 text-white rounded">${concern.status}</span>   
                        </div>
                        <div class="flex items-center justify-start">
                            ${editArchAccess}
                        </div>
                    </div>
                </div>
                `;
            }).join('');
        }).
        catch (error => {
            console.error(error);
        });
    }

    window.indexR = indexR;
    
});


