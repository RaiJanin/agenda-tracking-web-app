/**
 * 
 * @param {number} agendaId - Data ID to delete 
 * @returns 
 */

export async function deleteAgenda (agendaId) {

    try {
        const response = await fetch(`/agendas/${agendaId}`, {
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
        showNotification('Internal Server Error', 'error');
    }
}

/**
 * Force delete data
 * @param {number} agendaId - Data ID to delete
 * @returns 
 */
export async function forceDeleteAgenda (agendaIdDel) {

    try {
        const response = await fetch(`/agendas/${agendaIdDel}/fDelete`, {
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
        showNotification('Internal server error', 'error');
    }
}