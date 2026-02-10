<div class="flex items-center justify-center mt-28">
    <div class="bg-white h-96 w-[24rem] rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-center p-3 mt-4">
            <h2 class="text-2xl font-bold text-gray-800 [text-shadow:2px_2px_4px_rgba(0,0,0,0.1)]">Login to continue</h2>
        </div>
        <!-- From Uiverse.io by z7dev --> 
        <form>
            <div class="flex items-center justify-center p-3 mt-6">
                <div class="relative">
                    <input id="username" name="username" type="text" placeholder="" class="w-58 md:w-64 border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" required/>
                    <label for="username" class="absolute -top-4 text-xs left-0 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 peer-placeholder-shown:top-1 peer-placeholder-shown:text-sm">
                        Username
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-center p-3 mt-3 ml-8">
                <div class="relative">
                    <input id="password" name="password" type="password" placeholder="" class="w-58 md:w-64 border-b border-gray-300 py-1 focus:border-b-2 focus:border-blue-700 transition-colors focus:outline-none peer bg-inherit" required/>
                    <button type="button" id="show-password" class="rounded-xl px-1 hover:bg-gray-300">
                        <i id="eye-icon" class="fa-solid fa-eye-slash"></i>
                    </button>
                    <label for="password" class="absolute -top-4 text-xs left-0 cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all peer-focus:text-blue-700 peer-placeholder-shown:top-1 peer-placeholder-shown:text-sm">
                        Password
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between px-14 md:px-16">
                <div class="flex justify-center">
                    <input type="checkbox" id="save-cred" name="save-cred">
                    <label for="save-cred" class="ml-2 text-xs text-gray-500">Remember me</label>
                </div>
                <a href="#" class="text-xs text-cyan-600">Forgot password?</a>
            </div>
            <div class="mt-6 flex items-center justify-center p-6">
                <button type="submit" id="login-btn" class="bg-blue-500 rounded-lg shadow-md text-white text-md font-medium hover:bg-blue-400 px-20 py-2">Log In</button>
            </div>
        </form>
    </div>
</div>