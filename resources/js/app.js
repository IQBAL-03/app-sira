

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Auto close sidebar when resizing to desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        const sidebarOpen = Alpine.store('sidebarOpen');
        if (sidebarOpen !== undefined) {
            Alpine.store('sidebarOpen', false);
        }
    }
});

// Prevent body scroll when sidebar is open on mobile
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebarOpen', false);
    
    Alpine.effect(() => {
        const isOpen = Alpine.store('sidebarOpen');
        if (window.innerWidth < 1024) {
            if (isOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
    });
});
