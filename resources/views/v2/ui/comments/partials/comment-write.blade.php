<div id="write-comment-container" class="fixed bottom-0 w-full border-t-2 border-gray-300 bg-white shadow z-20 transition-all duration-300 ease-in-out">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4">
        <button id="write-comment-btn" type="button" class="flex items-center gap-2 text-sm bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-400 transition ml-3">
            <i class="fa-solid fa-plus text-xs"></i><span>Write a comment</span>
        </button>
    </div>
</div>
<div id="comment-write-section" class="fixed grid grid-cols-3 bottom-0 w-full border-t-2 border-gray-300 bg-white shadow z-20 translate-y-full transition-all duration-300 ease-in-out">
    <div class="p-4 col-span-3 sm:col-span-2 gap-3">
        <form class="flex flex-col gap-3"> 
            <div class="flex items-center justify-between">
                <h3 class="text-gray-600 text-md">Write a comment...</h3>
                <div class="flex flex-row gap-2">
                    <button type="button" class="close-comment relative group flex items-center px-4 py-2 text-red-600 hover:text-red-500 transition-all duration-300">
                        <i class="text-2xl fa-solid fa-rectangle-xmark"></i>
                        <span class="absolute top-0 right-0 translate-y-[-100%] px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-30">
                            Close Comment Field
                        </span>
                    </button>
                    <button type="button" id="submit-comment" class="relative group flex items-center px-4 py-2 text-blue-600 mr-5 hover:text-blue-500 transition-all duration-300">
                        <i class="text-xl fa-solid fa-paper-plane"></i>
                        <span class="absolute top-0 right-0 translate-y-[-100%] px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-30">
                            Upload Comment
                        </span>
                    </button>
                </div>
            </div>
            <input type="hidden" id="concern-id" name="concern_id" value="{{ $concern_id }}">
            <textarea name="write_comm" id="comment" rows="3" class="w-full border rounded-md p-2 resize-none" required></textarea>
        </form>
    </div>
    <div></div>
</div>

