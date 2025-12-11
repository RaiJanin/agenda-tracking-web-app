import { deleteAgenda } from "../rest-api/deleteAgenda.js";

document.addEventListener('DOMContentLoaded', () => {
    const agendaId = document.getElementById('agenda-id-data').getAttribute('data-agenda-id');
    
    document.getElementById('delete-agenda-btn').addEventListener('click', () => {
        isConfirm(agendaId);
    });

    function isConfirm(agendaId) {
        if(!confirm('Are you sure you want to delete this agenda?')) return;
        deleteAgenda(agendaId);
        window.location.href = `/app/view-agenda`;
    }
});

