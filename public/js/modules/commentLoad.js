import { timeAgo } from "../utilities/timeAgo.js";
import { showConfirmationModal } from "../components/cfFire.js";

document.addEventListener('DOMContentLoaded', function() {
    const commemtContainer = document.getElementById('comments-container');
    const concernId = document.getElementById('concern-id-data').getAttribute('data-concern-id');
    let commntId = null;

    function loadComments(idComments) {

        commntId = idComments;

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
                let editArchAccess = '';

                if(comments.roles.admin || comments.roles.me === comment.user_id) {
                    editArchAccess = `
                    <div class="text-sm rounded-lg bg-white border border-gray-400 mt-3">
                        <button class="edit-comment-btn border-r text-slate-500 border-gray-400 px-2 py-1 rounded-l-lg hover:text-slate-400" data-comment-id="${comment.id}">Edit</button>
                        <button class="delete-comment-btn px-2 text-red-600 py-1 rounded-r-lg hover:text-red-500" data-comment-id="${comment.id}">Delete</button>
                    </div>
                    `;
                }

                return `
                    <div class="flex flex-col p-3 rounded-xl bg-gray-100 border border-gray-200 mb-3">
                        <h2 class=" text-lg text-gray-700 font-semibold">${comment.user.name}</h2>
                        <p class="text-base p-3">${comment.content}</p>
                        <div class="flex items-center gap-4">
                            <p class="text-sm text-gray-600">${timeAgo(comment.updated_at)}</p>
                            ${editArchAccess}
                        </div>
                    </div>
                `;
            }).join('');

            addEventListener();

        }).
        catch (err => {
            console.error(err);
        });
    }
    window.loadComments = loadComments;

    function addEventListener() {
        document.querySelectorAll('.delete-comment-btn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();
                const commentId = button.getAttribute('data-comment-id');

                const isConfirmed = await showConfirmationModal('Confirm Delete?', 'Are you sure you want to delete this agenda?');
                if (!isConfirmed) return;

                console.log(commentId);
                loadComments(commntId);
            });
        });
    }

    loadComments(concernId);
});