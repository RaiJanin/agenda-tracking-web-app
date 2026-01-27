<div id="memberRequestModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="z-40 flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div class="inline-block bg-white align-middle items-center rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full z-50 relative">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Request Membership Access</h2>
                <form action="{{ route('store.memberRequest') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your full name" required>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div>
                        <label for="s_role" class="block text-sm font-medium text-gray-700">Department/Specific Role</label>
                        <input type="text" id="s_role" name="s_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g., IT, HR, Finance">
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        Submit Membership Request
                    </button>
                    <button type="button" class="cancel-request w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                        Cancel
                    </button>
                </form>
                <p class="text-sm text-gray-500 mt-4">Your request will be reviewed by the system administrator.</p>
            </div>
        </div>
    </div>
</div>
