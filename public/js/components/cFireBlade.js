document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('confirmationModal');
    const messageBox = document.getElementById('confirm-message');
    const title = document.getElementById('confirm-head');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');

    let pendingForm = null;

    document.body.addEventListener('submit', (e) => {
        const form = e.target.closest('.js-action-form');
        if (!form) return;

        const button = form.querySelector('button[type="submit"]');
        const message = button?.dataset.confirm;

        if (!message) return;

        e.preventDefault();

        pendingForm = form;
        messageBox.textContent = message;
        title.textContent = 'Confirm?';
        modal.classList.remove('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        closeModal();
    });

    confirmBtn.addEventListener('click', () => {
        if (pendingForm) {
            pendingForm.submit();
            pendingForm = null;
        }
        closeModal();
    });

    function closeModal() {
        modal.classList.add('hidden');
    }

});
