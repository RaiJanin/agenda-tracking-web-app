const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const toggleSidebarBtn = document.getElementById('toggle-sidebar');
const openSidebarBtn = document.getElementById('open-sidebar');
const mobileToggleSidebar = document.getElementById('mobile-toggle-sidebar');
const sideLogo = document.getElementById('side-logo');
const mainContent = document.querySelector('.flex-1');
const screenSize = window.matchMedia('(max-width: 768px)');
const userBtn = document.getElementById('user-btn');
const mobileUserDropdown = document.getElementById('user-dropdown');


function watchScreenSize(e) {
    if(e.matches) {
        toggleSidebarBtn.classList.add('hidden');
        openSidebarBtn.classList.add('hidden');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });

        mobileToggleSidebar.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });

        let isShown = false;

        function userDropdownFunction () {
            isShown = !isShown;
            if(isShown) {
                mobileUserDropdown.classList.remove('hidden');
            } else {
                mobileUserDropdown.classList.add('hidden');
            }
        }

        userBtn.addEventListener('click', userDropdownFunction);
    } else {
        toggleSidebarBtn.classList.remove('hidden');
        overlay.classList.remove('open');
        toggleSidebarBtn.addEventListener('click', () => toggleSidebar(true));
        openSidebarBtn.addEventListener('click', () => toggleSidebar(false));
    }
}

watchScreenSize(screenSize);
screenSize.addEventListener('change', watchScreenSize);


document.querySelectorAll('.accordion-group button').forEach(button => {
    button.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const arrow = this.querySelector('.accordion-arrow');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    });
});

function toggleSidebar(isCollapsed) {
    
    if (isCollapsed) {
        sidebar.classList.add('w-20');
        sidebar.classList.remove('w-64', 'overflow-auto');
        document.querySelectorAll('.sidebar-text').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.sidebar-tooltip').forEach(el => el.classList.remove('hidden'));
        toggleSidebarBtn.classList.add('hidden');
        openSidebarBtn.classList.remove('hidden');
        sideLogo.classList.add('hidden');
    } else {
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64', 'overflow-auto');
        document.querySelectorAll('.sidebar-text').forEach(el => el.classList.remove('hidden'));
        document.querySelectorAll('.sidebar-tooltip').forEach(el => el.classList.add('hidden'));
        toggleSidebarBtn.classList.remove('hidden');
        openSidebarBtn.classList.add('hidden');
        sideLogo.classList.remove('hidden');
    }
    
    feather.replace();
}
window.toggleSidebar = toggleSidebar;

feather.replace();