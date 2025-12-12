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
            }
        }).
        catch (err => {
            console.error(err);
        });
    }
    window.loadComments = loadComments;

    loadComments(concernId);
});