/**
 * 
 * @param {number} commentId - Comment ID of the edited comment
 * @param {string} commentContent - Edited Comment content
 */
export function updateComment(commentId, commentContent) {
    fetch(`/comments/${commentId}/update`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept' : 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            edited_comment: commentContent
        })
    })
    .then(async response => {
        const reply = await response.json();

        if(!reply.success) {
            showNotification(reply.message, 'error');
            return;
        }

        if(reply.success) {
            showNotification(reply.message, 'success');
        }

    })
    .catch(err => {
        showNotification('Internal server error', 'error');
        console.error(err);
    });
}