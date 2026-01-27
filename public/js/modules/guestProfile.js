document.addEventListener("DOMContentLoaded", () => {
    const memberRequestModal = document.getElementById('memberRequestModal');
    const cancelRequestBtn = document.querySelector('.cancel-request');
    const requestFormBtn = document.querySelector('.request-member-btn');

    requestFormBtn.addEventListener('click', () => {
        memberRequestModal.classList.toggle('hidden');
    });

    cancelRequestBtn.addEventListener('click', () => {
        memberRequestModal.classList.add('hidden');
    });
});