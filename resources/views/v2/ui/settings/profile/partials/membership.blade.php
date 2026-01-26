<section class="space-y-6 max-w-full">
    <div class="bg-blue-100 sm:rounded-md sm:rounded-tl-none w-full">
        <div class="flex rounded-br-3xl bg-blue-200 w-64 max-w-full">
            <h2 class="text-2xl font-medium text-gray-900 p-2 ml-4">
                {{ auth()->user()->name }}
            </h2>
        </div>

        @if(auth()->user()->role === 'user')
        <div class="p-2 mb-3">
            <div class="flex flex-row items-center gap-2 p-2 text-lg">
                <span class="text-gray-700 font-medium">Authority:</span>
                <span class="text-slate-600 font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
            <p class="p-2 text-gray-800">You're logged in as a guest. Getting a membership gives you access to,</p>
            <ul class="ml-3 mt-2 text-gray-700">
                <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Raising a concern</li>
                <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>View comments</li>
                <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Adding a comment</li>
            </ul>
        </div>

        <button type="button" onclick="window.location.href=`#`" class="request-member-btn inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white mb-2 ml-2 uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'">
            Request Membership
        </button>
        @endif

        @if(in_array(auth()->user()->role, ['admin', 'member']))
        <div class="p-2">
            <div class="flex flex-row items-center gap-2 p-2 text-lg">
                <span class="text-gray-700 font-medium">Authority:</span>
                <span class="text-slate-600 font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
            <div class="flex flex-col p-2">
                @if(in_array(auth()->user()->role, ['member', 'admin']))
                <h3 class="text-gray-600 font-medium text-lg">Role: <span class="text-gray-600">{{ auth()->user()->specific_role }}</span></h3>
                @endif
                @if(auth()->user()->role === 'admin')
                <ul class="ml-3 mt-2 text-gray-700">
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Full application access</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Overall data override</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Generate reports and archiving data</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Manage accounts</li>
                </ul>
                @endif
                @if(auth()->user()->role === 'member')
                <ul class="ml-3 mt-2 text-gray-700">
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Calendar events viewing</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Raise concerns</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Manage concerns</li>
                    <li><i class="fa-solid fa-check text-green-500 text-lg px-4"></i>Add comments</li>
                </ul>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
