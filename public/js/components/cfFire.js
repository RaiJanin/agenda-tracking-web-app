const confirmmodal = document.getElementById("confirmationModal");
const head = document.getElementById("confirm-head");
const msg = document.getElementById("confirm-message");
const confirmBtn = document.getElementById("confirmBtn");
const cancelBtn = document.getElementById("cancelBtn");

let resolvePromise = null;

export function showConfirmationModal(title, message) {
    
    head.textContent = title;
    msg.textContent = message;

    confirmmodal.classList.remove("hidden");

    return new Promise((resolve) => {
        resolvePromise = resolve;
    });

}

function closeModal(result) {
    confirmmodal.classList.add("hidden");

    if (resolvePromise) {
        resolvePromise(result);
        resolvePromise = null;
    }
}

confirmBtn.addEventListener("click", (e) => {
    e.preventDefault();
    closeModal(true);
});

cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();
    closeModal(false);
});

window.onclick = function(event) {
    if(event.target == confirmmodal) {
        closeModal(false);
    }
}