/**
 * FAQ Accordion functionality
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // Znajdź wszystkie akordeony FAQ na stronie
    const faqAccordions = document.querySelectorAll('.faq-accordion');
    
    faqAccordions.forEach(accordion => {
        // Znajdź wszystkie przyciski akordeonu
        const buttons = accordion.querySelectorAll('.faq-accordion__button');
        
        // Dodaj obsługę kliknięcia dla każdego przycisku
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Sprawdź aktualny stan
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                // Jeśli akordeon ma być zamknięty, zamknij wszystkie otwarte sekcje
                if (!isExpanded) {
                    // Zamknij wszystkie otwarte sekcje
                    buttons.forEach(btn => {
                        const btnIsExpanded = btn.getAttribute('aria-expanded') === 'true';
                        if (btnIsExpanded) {
                            // Zmień stan przycisku
                            btn.setAttribute('aria-expanded', 'false');
                            
                            // Ukryj panel
                            const panelId = btn.getAttribute('aria-controls');
                            const panel = document.getElementById(panelId);
                            if (panel) {
                                panel.hidden = true;
                            }
                        }
                    });
                }
                
                // Przełącz stan klikniętego przycisku
                this.setAttribute('aria-expanded', !isExpanded);
                
                // Pokaż lub ukryj panel
                const panelId = this.getAttribute('aria-controls');
                const panel = document.getElementById(panelId);
                
                if (panel) {
                    panel.hidden = isExpanded;
                }
            });
        });
        
        // Obsługa klawiszy dla dostępności
        accordion.addEventListener('keydown', function(event) {
            const target = event.target;
            
            // Sprawdź, czy naciśnięty klawisz to strzałka i czy cel to przycisk akordeonu
            if (!target.classList.contains('faq-accordion__button')) {
                return;
            }
            
            // Znajdź wszystkie przyciski w tym akordeonie
            const buttons = Array.from(accordion.querySelectorAll('.faq-accordion__button'));
            const index = buttons.indexOf(target);
            
            // Obsługa klawiszy strzałek
            switch (event.key) {
                case 'ArrowDown':
                    event.preventDefault();
                    if (index < buttons.length - 1) {
                        buttons[index + 1].focus();
                    }
                    break;
                case 'ArrowUp':
                    event.preventDefault();
                    if (index > 0) {
                        buttons[index - 1].focus();
                    }
                    break;
                case 'Home':
                    event.preventDefault();
                    buttons[0].focus();
                    break;
                case 'End':
                    event.preventDefault();
                    buttons[buttons.length - 1].focus();
                    break;
            }
        });
    });
});