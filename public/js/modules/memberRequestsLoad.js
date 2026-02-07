import { showConfirmationModal } from "../components/cfFire.js";
import { timeAgo } from "../utilities/timeAgo.js";

document.addEventListener("DOMContentLoaded", () => {
    const memberRequestsContainer = document.getElementById('member-request-container');
    const viewMemberRequestModal = document.getElementById('viewMemRequestModal');

    indexReload();
    function indexReload() {
        memberRequestsContainer.innerHTML = '';
        memberRequestsContainer.innerHTML = `
                <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                    <p class="text-sm text-gray-500">Loading</p>
                </div>
        `;
        fetch(`/membership-requests/get-all`, {
            method: 'GET',
            headers: {"Accept" : "application/json"}
        })
        .then(async response => {
            try {
                const requests = await response.json();
                
                console.log(requests);

                if(requests.length === 0) {
                    memberRequestsContainer.innerHTML = `
                        <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                            <p class="text-gray-500 font-small">No requests yet</p>
                        </div>
                    `;
                    return;
                }

                memberRequestsContainer.innerHTML = requests.map(member => {
                    return `
                        <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                            <p class="text-lg text-gray-800 font-medium">${member.name}</p>
                            <p class="ml-4 text-base text-gray-600">${timeAgo(member.created_at)}</p>
                            <div class="flex flex-row gap-2 mt-3">
                                <button class="view-req-btn rounded-lg bg-blue-500 text-white font-medium text-sm py-2 px-8 hover:bg-blue-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300" data-memReq-id="${member.id}">View</button>
                                <button class="rounded-lg bg-gray-500 text-white font-medium text-sm py-2 px-8 hover:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">Delete</button>
                            </div>
                        </div>
                    `;
                }).join('');

                eventListeners();
            } catch (err) {
                showNotification('Internal server error', 'error');
                console.error(err);
            }
        });
    }

    function eventListeners() {
        document.querySelectorAll('.view-req-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const memRequestId = btn.getAttribute('data-memReq-id');
                console.log('Clicked: '+memRequestId);
                viewMemberRequestModal.classList.toggle('hidden');
            });
        });
    }
})