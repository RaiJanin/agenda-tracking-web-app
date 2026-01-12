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
            alert(result.message);
            return;
        }

        alert(result.message);

    } catch (err) {
        console.error(err);
        alert('Internal Server Error');
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
            alert(result.message);
            return;
        }

        alert(result.message);

    } catch (err) {
        console.error(err);
        alert('Internal Server Error');
    }
}