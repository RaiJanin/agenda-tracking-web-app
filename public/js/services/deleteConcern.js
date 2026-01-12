/**
 * 
 * @param {number} concernId - Data ID to delete
 * @returns 
 */
export async function deleteConcern (concernId) {

    try {
        const response = await fetch(`${window.location.origin}/concerns/delete/${concernId}`, {
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
        return;
    }
}

/**
 * Force delete data
 * @param {number} concernIdDel - Data ID to delete
 * @returns 
 */
export async function forceDeleteConcern (concernIdDel) {

    try {
        const response = await fetch(`/concerns/${concernIdDel}/fDelete`, {
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