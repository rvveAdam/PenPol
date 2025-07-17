/**
 * Mobile Menu functionality
 * 
 * @package Pen-pol
 * @since 1.0.0
 */
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileNavigation = document.getElementById('mobile-navigation');
    
    if (!mobileMenuToggle || !mobileNavigation) return;
    
    // Otwieranie/zamykanie menu mobilnego
    mobileMenuToggle.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        if (isExpanded) {
            // Zamykanie menu
            this.setAttribute('aria-expanded', 'false');
            mobileNavigation.classList.remove('is-active');
            mobileNavigation.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('menu-open');
        } else {
            // Otwieranie menu
            this.setAttribute('aria-expanded', 'true');
            mobileNavigation.classList.add('is-active');
            mobileNavigation.setAttribute('aria-hidden', 'false');
            document.body.classList.add('menu-open');
        }
    });
    
    // Dodaj obsługę submenu na mobile
    const mobileMenuItems = document.querySelectorAll('.mobile-nav .menu-item-has-children');
    
    mobileMenuItems.forEach(function(item) {
        const submenuToggle = document.createElement('button');
        submenuToggle.className = 'mobile-submenu-toggle';
        submenuToggle.setAttribute('aria-expanded', 'false');
        submenuToggle.innerHTML = '<img src="/wp-content/themes/pen-pol/assets/images/chevron-down.svg" class="mobile-menu-icon-dropdown" alt="" aria-hidden="true">';
        
        const link = item.querySelector('a');
        if (link) {
            link.after(submenuToggle);
        }
        
        const submenu = item.querySelector('.sub-menu');
        if (submenu) {
            submenu.hidden = true;
        }
        
        submenuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                // Zamykanie submenu
                this.setAttribute('aria-expanded', 'false');
                if (submenu) {
                    submenu.hidden = true;
                }
            } else {
                // Otwieranie submenu
                this.setAttribute('aria-expanded', 'true');
                if (submenu) {
                    submenu.hidden = false;
                }
            }
        });
    });
});
