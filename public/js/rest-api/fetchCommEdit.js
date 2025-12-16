import { commentState } from "../state/comment.js";
import { renderEdit } from "../modules/commentEdit.js";

export function loadCommToEdit(commentId) {
    console.log('Received ID: '+commentId);

    fetch(`/comments/${commentId}/edit`, {
        method: 'GET',
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Accept": "application/json"
        }
    }).
    then(async response => {
        const data = await response.json();

        if(!data.success) {
            alert('Something went wrong. Please try again later');
            return;
        }

        if(data.success) {
            commentState.commentContent = data.comment.content;
            commentState.commentId = data.comment.id;
            renderEdit();
        }
    })
    .catch (err => {
        console.error(err);
    });
}
