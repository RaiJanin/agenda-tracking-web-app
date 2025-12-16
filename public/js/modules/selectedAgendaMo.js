import { deleteAgenda } from "../rest-api/deleteAgenda.js";
import { showConfirmationModal } from "../components/cfFire.js";

document.addEventListener('DOMContentLoaded', () => {
    const agendaId = document.getElementById('agenda-id-data').getAttribute('data-agenda-id');
    
    document.getElementById('delete-agenda-btn').addEventListener('click', () => {
        isConfirm(agendaId);
    });

    async function isConfirm(agendaId) {
        const isConfirmed = await showConfirmationModal('Confirm Delete?', 'Are you sure you want to delete this agenda?');
        if (!isConfirmed) return;
        deleteAgenda(agendaId);
        window.location.href = `/app/view-agenda`;
    }
});

