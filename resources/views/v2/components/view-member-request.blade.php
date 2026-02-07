<div id="viewMemRequestModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="z-40 flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div class="inline-block bg-white align-middle items-center rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full z-50 relative">
            <div class="bg-blue-100 sm:rounded-md sm:rounded-tl-none w-full">
                <div class="p-2 mb-3">
                    <div class="flex flex-row items-center gap-2 p-2 text-lg">
                        <span class="text-gray-700 font-medium">Authority:</span>
                        <span class="text-slate-600 font-semibold">{{ __('') }}</span>
                    </div>
                    <p class="p-2 text-gray-800">You're logged in as a guest. Getting a membership gives you access to,</p>
                    <ul class="ml-3 mt-2 text-gray-700">
                        <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Raising a concern</li>
                        <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>View comments</li>
                        <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Adding a comment</li>
                    </ul>
                </div>

                <button type="button" class="request-member-btn inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-2 uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                    Request Membership
                </button>
            </div>
        </div>
    </div>
</div>
