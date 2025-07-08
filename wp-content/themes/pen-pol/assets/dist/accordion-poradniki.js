/**
 * Accordion functionality for poradniki section
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Znajdź wszystkie akordeony na stronie
    const accordions = document.querySelectorAll('.poradniki-accordion');
    
    accordions.forEach(accordion => {
        // Znajdź elementy danego akordeonu
        const tabs = accordion.querySelectorAll('.poradniki-accordion__tab');
        const swiperContainer = accordion.querySelector('.poradniki-accordion__panels');
        
        if (!swiperContainer || tabs.length === 0) return;
        
        // Inicjalizacja Swipera dla paneli akordeonu
        const accordionSwiper = new Swiper(swiperContainer, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            allowTouchMove: false,
            speed: 300,
            on: {
                init: function () {
                    // Ustawienie pierwszego slajdu jako aktywny
                    this.slideTo(0, 0);
                }
            }
        });
        
        // Obsługa kliknięcia w zakładki akordeonu
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabIndex = parseInt(this.dataset.index);
                const isActive = this.classList.contains('active');
                
                // Jeśli już aktywny, nie robimy nic
                if (isActive) return;
                
                // Usuwamy aktywną klasę ze wszystkich zakładek
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                
                // Dodajemy aktywną klasę do klikniętej zakładki
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                
                // Przełączamy Swiper na odpowiedni slajd
                accordionSwiper.slideTo(tabIndex);
                
                // Ukrywamy wszystkie panele
                const allPanels = accordion.querySelectorAll('.poradniki-accordion__panel');
                allPanels.forEach(panel => {
                    panel.hidden = true;
                });
                
                // Pokazujemy aktywny panel
                const activePanel = accordion.querySelector(`.poradniki-accordion__panel[data-index="${tabIndex}"]`);
                if (activePanel) {
                    activePanel.hidden = false;
                }
            });
        });
    });
});