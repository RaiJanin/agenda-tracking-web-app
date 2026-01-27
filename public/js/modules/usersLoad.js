import { timeAgo } from "../utilities/timeAgo.js";

document.addEventListener('DOMContentLoaded', function () {

    indexR();
    memberRqstsPrev();
    function indexR(page = 1) {
        const usersContainer = document.getElementById('user-container');

        usersContainer.innerHTML = '';

        handlePagination(null, null, false);

        fetch(`/profiles?page=${page}`, {
            method: 'GET',
            headers: {"Accept" : "application/json"}
        })
        .then(async response => {
            
            try {
                const users = await response.json();
                console.log(users);

                handlePagination(users, 'indexR', true);

                usersContainer.innerHTML = users.data.map(user => {
                    let userRole = '';

                    switch(user.role) {
                        case 'user':
                            userRole = `
                                <div class="bg-emerald-200 text-emerald-500 py-5 px-6 rounded-full border border-emerald-500">
                                    <i class="fa-solid fa-user-tie text-4xl"></i>
                                </div>
                            `;
                            break;
                        case 'member':
                            userRole = `
                                <div class="bg-white text-green-500 py-5 px-6 rounded-full border border-green-500">
                                    <i class="fa-solid fa-user-tie text-4xl"></i>
                                </div>
                            `;
                            break;
                        case 'secretary':
                            userRole = `
                                <div class="bg-amber-200 text-amber-500 py-5 px-6 rounded-full border border-amber-500">
                                    <i class="fa-solid fa-user-tie text-4xl"></i>
                                </div>
                            `;
                            break;
                        default:
                            userRole = `
                                <div class="bg-blue-200 text-blue-500 py-5 px-6 rounded-full border border-blue-500">
                                    <i class="fa-solid fa-user-tie text-4xl"></i>
                                </div>
                            `;
                            break;
                    }

                    return `
                        <div class="flex items-center gap-4 bg-gray-100 p-3 rounded-xl shadow border-2 border-gray-200">
                            <div class="flex flex-col items-center">
                                ${userRole}
                            </div>
                            <div class="relative">
                                <h2 class="text-2xl font-bold">${user.name}</h2>
                                <p class="mt-2 text-gray-600 font-medium bg-gray-200 p-1 pl-4 rounded-md">${user.role}</p>
                                <p class="ml-4 mt-1 text-sm text-gray-500">${user.email}</p>
                                <div class="flex item-center justify-start mt-4">
                                    <button class="bg-gray-100 border border-green-500 text-green-600 rounded-md 
                                        hover:bg-green-200 focus:ring-2 focus:ring-green-400 focus:ring-offset-1 
                                        px-3 py-1 transition-all duration-400">
                                        View
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                }).join('');
            } catch (error) {
                showNotification('Internal serve error', 'error');
                console.error(error);
            }
        });
    }
    window.indexR = indexR;
    
    function memberRqstsPrev () {
        const memberRequestPrevContainer = document.getElementById('member-request-container');

        const memberRequests = [
            {
                id: 1,
                name: "Carlos Sainz",
                dateCreated: "2026-01-25"
            },
            {
                id: 2,
                name: "Lewis Hamilton",
                dateCreated: "2026-01-25"
            },
            {
                id: 3,
                name: "George Rusells",
                dateCreated: "2026-01-26"
            },
            {
                id: 4,
                name: "Sergo Perez",
                dateCreated: "2026-01-23"
            },
            {
                id: 5,
                name: "Lando Norris",
                dateCreated: "2026-01-24"
            },
        ];

        memberRequestPrevContainer.innerHTML = '';
        memberRequestPrevContainer.innerHTML = memberRequests.map(member => {
            return `
                <div class="flex flex-col rounded-xl bg-gray-100 px-4 py-3">
                    <p class="text-lg text-gray-800 font-medium">${member.name}</p>
                    <p class="ml-4 text-base text-gray-600">${timeAgo(member.dateCreated)}</p>
                    <div class="flex flex-row gap-2 mt-3">
                        <button class="rounded-lg bg-blue-500 text-white font-medium text-sm py-2 px-8 hover:bg-blue-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">View</button>
                        <button class="rounded-lg bg-gray-400 text-white font-medium text-sm py-2 px-8 hover:bg-gray-500 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all duration-300">Delete</button>
                    </div>
                </div>
            `;
        }).join('');
    }
});