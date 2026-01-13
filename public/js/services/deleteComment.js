/**
 * 
 * @param {number} commentId - Data ID to delete 
 * @returns 
 */

export async function deleteComment (commentId) {

    try {
        const response = await fetch(`/comments/${commentId}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept' : 'application/json'
            }
        });

        const result = await response.json();

        if(!result.success) {
            showNotification(result.message, 'error');
            return;
        }

        showNotification(result.message, 'success');

    } catch (err) {
        console.error(err);
        showNotification('Internal sever error', 'error');
    }
}