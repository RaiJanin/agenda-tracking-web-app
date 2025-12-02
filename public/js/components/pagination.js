const pagination = document.getElementById('pagination');
const paginationMeta = document.getElementById('pagination-meta');

function handlePagination(meta, fname, enable) {

    if(!enable) {
        pagination.innerHTML = '';
        paginationMeta.innerHTML = '';
        return;
    }
    
    pagination.innerHTML ='';
    pagination.innerHTML += `
            <button onclick="${fname}(${meta.current_page - 1})" id="prevBtn" aria-label="Previous page" disabled class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-md text-gray-600 disabled:cursor-not-allowed disabled:text-gray-400 hover:bg-indigo-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
        `;
    if(meta.prev_page_url) {
        document.getElementById('prevBtn').disabled = false;
    }

    pagination.innerHTML += `
            <button onclick="${fname}(1)" id="firstPageBtn" aria-label="First page" disabled class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-md text-gray-600 disabled:cursor-not-allowed disabled:text-gray-400 hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7M20 19l-7-7 7-7" />
                </svg>
            </button>
    `;
    if(meta.current_page !== 1) {
        document.getElementById('firstPageBtn').disabled = false;
    }

    pagination.innerHTML += `
            <button id="currentPage" aria-label="Current page" disabled class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-md text-gray-600 disabled:text-gray-500 hover:bg-indigo-100 transition">
                ${meta.current_page}/${meta.last_page}
            </button>
    `;

    pagination.innerHTML += `
            <button onclick="${fname}(${meta.last_page})" id="lastPageBtn" aria-label="Last page" disabled class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-md text-gray-600 disabled:cursor-not-allowed disabled:text-gray-400 hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M4 5l7 7-7 7" />
                </svg>
            </button>
    `;

    if(meta.current_page !== meta.last_page) {
        document.getElementById('lastPageBtn').disabled = false;
    }

    pagination.innerHTML += `
            <button onclick="${fname}(${meta.current_page + 1})" id="nextBtn" aria-label="Next page" disabled class="flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-md text-gray-600 disabled:cursor-not-allowed disabled:text-gray-400 hover:bg-indigo-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
    `;
    if(meta.next_page_url) {
        document.getElementById('nextBtn').disabled = false;
    }

    paginationMeta.innerHTML = `
        <p class="block font-sans text-sm font-small leading-relaxed text-gray-700 antialiased break-words ml-2">
            Showing ${meta.from} to ${meta.to} of ${meta.total} results
        </p>
    `;
}
window.handlePagination = handlePagination;