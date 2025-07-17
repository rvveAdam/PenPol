/**
 * Mega Menu functionality with multi-level support
 * 
 * @package Pen-pol
 * @since 1.0.0
 */
document.addEventListener('DOMContentLoaded', function() {
    // Inicjalizacja mega menu
    initMegaMenu();
    
    function initMegaMenu() {
        // Znajdź wszystkie główne elementy menu (depth 0) z klasą mm-content
        const menuItems = document.querySelectorAll('.main-navigation .menu-item-has-children[data-depth="0"].mm-content');
        
        if (!menuItems.length) {
            console.log('Nie znaleziono elementów mega menu (z klasą mm-content)');
            return;
        }
        
        // Ukryj ikony chevron-down dla elementów bez klasy mm-content
        document.querySelectorAll('.main-navigation .menu-item-has-children:not(.mm-content) .menu-icon-dropdown').forEach(icon => {
            icon.style.display = 'none';
        });
        
        // Przetwarzanie każdego elementu głównego menu
        menuItems.forEach(menuItem => {
            // Znajdź wrapper mega menu
            const megaMenuWrapper = menuItem.querySelector('.mega-menu-wrapper');
            const menuLink = menuItem.querySelector('a');
            
            if (!megaMenuWrapper || !menuLink) return;
            
            // Znajdź kontener zawartości mega menu
            const megaContent = megaMenuWrapper.querySelector('.mega-menu-content');
            if (!megaContent) return;
            
            // Obsługa najechania na menu główne
            menuItem.addEventListener('mouseenter', () => {
                // Zamknij inne otwarte menu
                document.querySelectorAll('.mega-menu-wrapper.is-active').forEach(menu => {
                    if (menu !== megaMenuWrapper) {
                        menu.classList.remove('is-active');
                    }
                });
                
                // Pokaż bieżące menu
                megaMenuWrapper.classList.add('is-active');
                menuLink.setAttribute('aria-expanded', 'true');
                
                // Inicjalizacja submenu
                setupSubmenu(megaMenuWrapper);
            });
            
            // Obsługa opuszczenia menu
            menuItem.addEventListener('mouseleave', () => {
                megaMenuWrapper.classList.remove('is-active');
                menuLink.setAttribute('aria-expanded', 'false');
                
                // Ukryj wszystkie kontenery submenu
                hideAllSubmenuContainers(megaMenuWrapper);
            });
        });
        
        // Modyfikuj nagłówek mega menu - dodaj odrębne stylowanie dla "Pen-Pol"
        const megaMenuTitles = document.querySelectorAll('.mega-menu-title');
        megaMenuTitles.forEach(title => {
            // Znajdź ostatnie wystąpienie "- Pen-Pol" i zastąp je spanem z klasą
            const text = title.innerHTML;
            if (text.includes('- Pen-Pol')) {
                const newText = text.replace('- Pen-Pol', '- <span class="brand-name">Pen-Pol</span>');
                title.innerHTML = newText;
            }
        });
    }
    
    function setupSubmenu(megaMenuWrapper) {
        // Znajdź elementy submenu poziomu 1
        const primaryMenu = megaMenuWrapper.querySelector('.mega-menu-primary');
        
        if (!primaryMenu) {
            console.error('Brak wymaganych elementów submenu (primary menu)');
            return;
        }
        
        // Znajdź wszystkie elementy poziomu 1
        const level1Items = primaryMenu.querySelectorAll('li[data-depth="1"]');
        
        if (!level1Items.length) {
            console.log('Brak elementów poziomu 1');
            return;
        }
        
        console.log('Znaleziono elementów poziomu 1:', level1Items.length);
        
        // Dodaj ikony chevron tylko do elementów z dziećmi (mm-content-depth1)
        level1Items.forEach(item => {
            // Sprawdź czy element ma klasę mm-content-depth1 (czyli ma dzieci)
            if (item.classList.contains('mm-content-depth1')) {
                const link = item.querySelector('a');
                // Dodaj chevron tylko gdy element ma klasę mm-content-depth1 i nie ma już dodanego chevrona
                if (link && !link.querySelector('.menu-chevron-right')) {
                    const chevron = document.createElement('img');
                    chevron.src = '/wp-content/themes/pen-pol/assets/images/chevron-right-black.svg';
                    chevron.className = 'menu-chevron-right';
                    chevron.alt = '';
                    chevron.setAttribute('aria-hidden', 'true');
                    link.appendChild(chevron);
                }
                
                // Ukryj chevron-down jeśli istnieje
                const chevronDown = link.querySelector('.menu-icon-dropdown');
                if (chevronDown) {
                    chevronDown.style.display = 'none';
                }
            }
        });
        
        // Utwórz lub pobierz kontenery dla różnych poziomów
        ensureSubmenuContainers(megaMenuWrapper);
        
        // Ukryj wszystkie kontenery głębszych poziomów na start
        hideDepthContainers(megaMenuWrapper, 2);
        
        // Obsługa najechania na elementy poziomu 1
        level1Items.forEach(item => {
            // Sprawdzamy czy element ma klasę mm-content-depth1
            if (item.classList.contains('mm-content-depth1')) {
                item.addEventListener('mouseenter', function() {
                    console.log('Najechano na element poziomu 1:', this.textContent.trim());
                    
                    // Usuń klasę active ze wszystkich elementów
                    level1Items.forEach(i => i.classList.remove('active'));
                    
                    // Dodaj klasę active do bieżącego elementu
                    this.classList.add('active');
                    
                    // Ukryj wszystkie kontenery głębszych poziomów 
                    hideDepthContainers(megaMenuWrapper, 2);
                    
                    // Pokaż submenu poziomu 2 tylko dla tego elementu
                    showDepthSubmenu(this, 2, megaMenuWrapper);
                });
            }
        });
        
        // Domyślnie pokaż submenu dla pierwszego elementu poziomu 1 z klasą mm-content-depth1
        const firstDepth1Item = Array.from(level1Items).find(item => 
            item.classList.contains('mm-content-depth1')
        );
        
        if (firstDepth1Item) {
            firstDepth1Item.classList.add('active');
            // Nie pokazujemy żadnego submenu depth2 domyślnie - użytkownik musi najpierw naechać na element depth1
        }
    }
    
    function ensureSubmenuContainers(megaMenuWrapper) {
        const megaContent = megaMenuWrapper.querySelector('.mega-menu-content');
        if (!megaContent) return;
        
        // Usuń wszystkie istniejące kontenery submenu
        const existingContainers = megaContent.querySelectorAll('.mega-menu-submenu-container');
        existingContainers.forEach(container => container.remove());
        
        // Utwórz kontenery dla poziomów 2-5
        for (let depth = 2; depth <= 5; depth++) {
            const submenuContainer = document.createElement('div');
            submenuContainer.className = `mega-menu-submenu-container depth-${depth}`;
            submenuContainer.setAttribute('data-depth', depth);
            submenuContainer.style.display = 'none';
            
            // Dodaj zawartość kontenera
            const containerContent = document.createElement('div');
            containerContent.className = 'mega-menu-submenu-content';
            submenuContainer.appendChild(containerContent);
            
            megaContent.appendChild(submenuContainer);
        }
    }
    
    function hideAllSubmenuContainers(megaMenuWrapper) {
        const containers = megaMenuWrapper.querySelectorAll('.mega-menu-submenu-container');
        containers.forEach(container => {
            container.style.display = 'none';
            container.classList.remove('fade-in');
        });
    }
    
    function hideDepthContainers(megaMenuWrapper, fromDepth) {
        // Ukryj wszystkie kontenery od określonej głębokości w górę
        for (let depth = fromDepth; depth <= 5; depth++) {
            const container = megaMenuWrapper.querySelector(`.mega-menu-submenu-container[data-depth="${depth}"]`);
            if (container) {
                container.style.display = 'none';
                container.classList.remove('fade-in');
            }
        }
    }
    
    function showDepthSubmenu(parentItem, depth, megaMenuWrapper) {
        console.log(`Pokazuję submenu poziomu ${depth} dla:`, parentItem.textContent.trim());
        
        // Znajdź submenu dla danego poziomu
        const submenu = parentItem.querySelector(`.sub-menu.level-${depth}`);
        
        if (!submenu) {
            console.log(`Brak submenu poziomu ${depth}`);
            return;
        }
        
        // Znajdź kontener dla danego poziomu
        const container = megaMenuWrapper.querySelector(`.mega-menu-submenu-container[data-depth="${depth}"]`);
        if (!container) {
            console.error(`Brak kontenera dla poziomu ${depth}`);
            return;
        }
        
        // Wyczyść zawartość kontenera
        const containerContent = container.querySelector('.mega-menu-submenu-content');
        if (!containerContent) return;
        containerContent.innerHTML = '';
        
        // Klonuj submenu i dodaj do kontenera
        const items = submenu.querySelectorAll('li');
        if (items.length > 0) {
            const itemsList = document.createElement('ul');
            itemsList.className = 'submenu-items-list';
            
            // Filtrujemy elementy, biorąc pod uwagę tylko te o odpowiedniej głębokości
            items.forEach(item => {
                // Sprawdź czy element ma odpowiedni atrybut data-depth
                const itemDepth = parseInt(item.getAttribute('data-depth'), 10);
                
                // Dodajemy tylko elementy z odpowiednią głębokością
                if (itemDepth === depth) {
                    const clonedItem = item.cloneNode(true);
                    // Usuń zagnieżdżone submenu z klonowanego elementu
                    const nestedSubmenus = clonedItem.querySelectorAll('.sub-menu');
                    nestedSubmenus.forEach(nested => nested.remove());
                    
                    // Dodaj ikonę chevron do linku tylko jeśli element ma dzieci (ma klasę mm-content-depth+)
                    const link = clonedItem.querySelector('a');
                    const hasSubmenu = clonedItem.classList.contains(`mm-content-depth${depth}`);
                    
                    if (link) {
                        // Ukryj chevron-down jeśli istnieje
                        const chevronDown = link.querySelector('.menu-icon-dropdown');
                        if (chevronDown) {
                            chevronDown.style.display = 'none';
                        }
                        
                        // Dodaj chevron-right tylko jeśli ma dzieci i nie ma już dodanego
                        if (hasSubmenu && !link.querySelector('.menu-chevron-right')) {
                            const chevron = document.createElement('img');
                            chevron.src = '/wp-content/themes/pen-pol/assets/images/chevron-right-black.svg';
                            chevron.className = 'menu-chevron-right';
                            chevron.alt = '';
                            chevron.setAttribute('aria-hidden', 'true');
                            link.appendChild(chevron);
                        }
                    }
                    
                    // Dodaj obsługę hover dla elementów z klasą mm-content-depth{depth}
                    if (hasSubmenu) {
                        clonedItem.addEventListener('mouseenter', function() {
                            // Usuń klasę active ze wszystkich elementów
                            itemsList.querySelectorAll('li').forEach(i => i.classList.remove('active'));
                            
                            // Dodaj klasę active do bieżącego elementu
                            this.classList.add('active');
                            
                            // Ukryj wszystkie kontenery głębszych poziomów
                            hideDepthContainers(megaMenuWrapper, depth + 1);
                            
                            // Znajdź oryginalny element w DOM, aby dostęp do jego submenu
                            const originalItem = findOriginalItem(item);
                            if (originalItem) {
                                showDepthSubmenu(originalItem, depth + 1, megaMenuWrapper);
                            }
                        });
                    }
                    
                    itemsList.appendChild(clonedItem);
                }
            });
            
            // Sprawdź czy lista ma elementy
            if (itemsList.children.length > 0) {
                containerContent.appendChild(itemsList);
                
                // Pokaż kontener z animacją
                container.style.display = 'block';
                // Dodaj klasę animacji po małym opóźnieniu
                setTimeout(() => {
                    container.classList.add('fade-in');
                }, 10);
            }
        }
    }
    
    function findOriginalItem(item) {
        if (!item) return null;
        
        // Pobierz identyfikator elementu menu
        const itemId = item.id;
        
        // Znajdź oryginalny element w DOM
        return document.getElementById(itemId);
    }
});