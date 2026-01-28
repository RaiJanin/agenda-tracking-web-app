<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="confirm-terminate-btn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'">
        Delete Account
    </button>

    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

    <div class="confirm-terminate hidden fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
        <div class="fixed inset-0 transform transition-all">
            <div class="absolute inset-0 bg-gray-500 opacity-75">
            </div>
            <div class="mb-6 bg-white rounded-lg overflow-hidden opacity-100 shadow-xl transform transition-all sm:w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl sm:mx-auto">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}"
                        />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button id="cancel-btn" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const confirmTerminateModal = document.querySelector('.confirm-terminate');
        document.querySelector('.confirm-terminate-btn').addEventListener('click', () => {
            confirmTerminateModal.classList.toggle('hidden');
        });

        document.getElementById('cancel-btn').addEventListener('click', () => {
            confirmTerminateModal.classList.add('hidden');
        });
    </script>
</section>
