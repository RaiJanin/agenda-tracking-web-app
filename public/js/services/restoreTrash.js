/**
 * Restore deleted agenda
 * @param {number} agendaIdRes - Data ID to restore
 * @returns 
 */
export async function restoreAgenda (agendaIdRes) {

    try {
        const response = await fetch(`/agendas/${agendaIdRes}/restore`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept' : 'application/json',
                'Content-Type': 'application/json'
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
 * Restore deleted concerns
 * @param {number} concernIdRes - Data ID to restore
 * @returns 
 */
export async function restoreConcern (concernIdRes) {

    try {
        const response = await fetch(`/concerns/${concernIdRes}/restore`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept' : 'application/json',
                'Content-Type': 'application/json'
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