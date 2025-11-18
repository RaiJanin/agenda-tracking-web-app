async function archivedAgenda (agendaId) { //loaded from resources/views/v2/pages/agenda/view-all.blade

    try {
        const response = await fetch(`/agendas/${agendaId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept' : 'application/json'
            }
        });

        const result = await response.json();
        console.log(result);

        if(!result.success) {
            alert(result.message);
            return;
        }

        alert('Agenda archived successfully.');
        indexR(); ///reload agendas container

        console.log(result);
    } catch (err) {
        console.error(err);
        alert('Internal Server Error');
    }
}