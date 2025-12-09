import { archivedAgenda } from "../rest-api/archiveAgenda.js";

document.addEventListener('DOMContentLoaded', () => {
    const agendaId = document.getElementById('agenda-id-data').getAttribute('data-agenda-id');
    
    document.getElementById('archive-agenda-btn').addEventListener('click', () => {
        isConfirm(agendaId);
    });

    function isConfirm(agendaId) {
        if(!confirm('Are you sure you want to archive this agenda?')) return;
        archivedAgenda(agendaId);
        window.location.href = `/app/view-agenda`;
    }
});

