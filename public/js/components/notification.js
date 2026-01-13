/**
 * 
 * @param {string} message - Message string
 * @param {'success'|'caution'|'error'} type - Message type
 * @param {number} duration - Notification duration. Default - 4000
 */
function showNotification(message, type, duration = 4000) {
    const container = document.getElementById('notification-container');
    const notificationId = `notification-${Date.now()}`;

    const notification = document.createElement('div');
    notification.id = notificationId;
    notification.className = `bg-gray-50 border border-gray-200 text-black rounded-lg shadow-md overflow-hidden animate-slideIn relative transition-all duration-300`;
    notification.setAttribute('role', 'alert');
    notification.setAttribute('aria-live', 'assertive');

    let typeIcon = null;
    switch(type) {
        case 'success':
            typeIcon = `
                <i class="fa-solid fa-square-check px-2 text-lg text-green-500"></i>
            `;
            break;
        case 'caution':
            typeIcon = `
                <i class="fa-solid fa-circle-exclamation px-2 text-lg text-yellow-400"></i>
            `;
            break;
        case 'error':
            typeIcon = `
                <i class="fa-solid fa-circle-exclamation px-2 text-lg text-red-600"></i>
            `;
            break;
        default:
            typeIcon = '';
            break;
    }

    notification.innerHTML = `
        <div class="flex items-start p-4">
            
            <div class="flex-1">
                <p class="text-sm font-medium">${typeIcon} ${message}</p>
            </div>
            <button onclick="dismissNotification('${notificationId}')" class="ml-4 text-black hover:text-gray-200 focus:outline-none" aria-label="Close notification">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="absolute bottom-0 left-0 h-1 bg-black bg-opacity-30">
            <div class="progress-bar-fill h-1 bg-gray" style="width: 100%; animation: shrink ${duration}ms linear forwards;"></div>
        </div>
    `;

    container.prepend(notification);

    const timeout = setTimeout(() => {
        dismissNotification(notificationId);
    }, duration);

    notification.timeout = timeout;
}
window.showNotification = showNotification;

function dismissNotification(id) {
    const notification = document.getElementById(id);
    if (notification) {
        clearTimeout(notification.timeout);
        notification.classList.remove('animate-slideIn');
        notification.classList.add('animate-slideOut');

        notification.addEventListener('animationend', () => {
            notification.remove();
        }, { once: true });
    }
}