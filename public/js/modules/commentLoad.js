import { timeAgo } from "../components/timeAgo.js";

document.addEventListener('DOMContentLoaded', function() {
    const commemtContainer = document.getElementById('comments-container');
    const concernId = document.getElementById('concern-id-data').getAttribute('data-concern-id');

    function loadComments(idComments) {

        commemtContainer.innerHTML = '<p class="text-md p-4 ml-7 text-gray-400">Loading comments...</p>';

        fetch(`/comments/${idComments}/load`, {
            method: 'GET',
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Accept": "application/json"
            }
        }).
        then(async response => {
            const comments = await response.json();

            console.log(comments);

            if(!comments.success) {
                alert('Something went wrong. Please try again later');
                return;
            }

            if(comments.data.length == 0) {
                commemtContainer.innerHTML = `
                    <div class="flex items-center justify-center p-6">
                        <h3 class="text-lg text-gray-600">No comments yet</h3>
                    </div>
                `;
                return;
            }

            commemtContainer.innerHTML = comments.data.map(comment => {
                return `
                    <div class="flex flex-col p-3 rounded-xl bg-gray-100 border border-gray-200 mb-3">
                        <h2 class=" text-lg text-gray-700 font-semibold">${comment.user.name}</h2>
                        <p class="text-base p-3">${comment.content}</p>
                        <div class="flex items-center gap-4">
                            <p class="text-sm text-gray-600">${timeAgo(comment.updated_at)}</p>
                            <!--<div class="text-sm rounded-lg bg-white border border-gray-400 mt-3">
                                <button class="edit-comment-btn border-r text-slate-500 border-gray-400 px-2 py-1 rounded-l-lg hover:text-slate-400" data-comment-id="${comment.id}">Edit</button>
                                <button class="delete-comment-btn px-2 text-red-600 py-1 rounded-r-lg hover:text-red-500" data-comment-id="${comment.id}">Delete</button>
                            </div>-->
                        </div>
                    </div>
                `;
            }).join('');
        }).
        catch (err => {
            console.error(err);
        });
    }
    window.loadComments = loadComments;

    loadComments(concernId);
});