import { showConfirmationModal } from "../components/cfFire.js";
import { forceDeleteConcern } from "../services/deleteConcern.js";
import { restoreConcern } from "../services/restoreTrash.js";

document.addEventListener("DOMContentLoaded", () => {
    const trashedConcernsCont = document.getElementById('trashedConcerns-data');

    function indexR() {
        trashedConcernsCont.innerHTML = `
        <tr>
            <td colspan="4" class="px-6 py-4 text-center text-gray-600">Loading...</td>
        </tr>
        `;

        fetch(`/c0nC3rn/trash-concerns`, {
            method: 'GET',
            headers: { "Accept": "application/json" }
        })
        .then(async response => {
            const text = await response.text();
            try {
                const data = JSON.parse(text);
                // console.log(data);
                trashedConcernsCont.innerHTML = '';

                if(!data.success) {
                    alert('Something went wrong');
                    console.log('Failed to load data.PHP error');
                    return;
                }

                if(data.contents.length === 0) {
                    trashedConcernsCont.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Trash bin is empty.</td>
                    </tr>
                    `;
                    return;
                }

                trashedConcernsCont.innerHTML = data.contents.map(concern => {
                    let actionBtns = '';
                    if(data.member_role || data.admin_access) {
                        actionBtns = `
                        <div class="flex flex-row gap-2">
                            <button type="button" class="delBtn text-red-600 hover:underline" data-Tconcern-id="${concern.concern_id}">Delete</button>
                            <button type="button" class="restoreBtn text-blue-600 hover:underline" data-Tconcern-id="${concern.concern_id}">Restore</button>
                        </div>
                        `;
                    }

                    return `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-medium min-w-40 max-w-64">${concern.description}</td>
                            <td class="px-6 py-3 min-w-40">${concern.responsible.name}</td>
                            <td class="px-6 py-3 text-center space-x-3">
                                ${actionBtns}
                            </td>
                        </tr>
                    `;
                }).join('');

                addEventListeners();

            } catch (err) {
                console.error(err);
            }
        });
    }

    function addEventListeners() {
        document.querySelectorAll('.delBtn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const concernID = button.getAttribute('data-Tconcern-id');
                const isConfirmed = await showConfirmationModal('Delete Permanently?', 'This will delete the data permanently, proceed?');
                if (!isConfirmed) return;
                // console.log(concernID);
                forceDeleteConcern(concernID);
                indexR();
            });
        });
        document.querySelectorAll('.restoreBtn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const concernID = button.getAttribute('data-Tconcern-id');
                // console.log(concernID);
                restoreConcern(concernID);
                indexR();
            });
        });
    }

    indexR();
})