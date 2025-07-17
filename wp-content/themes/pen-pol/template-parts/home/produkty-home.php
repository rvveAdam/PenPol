<?php
/**
 * Template Part: Products Section for Homepage
 * 
 * Displays categories tabs and products carousel
 * Uses ACF fields: sg-produktowa group and WooCommerce category fields
 * Location: template-parts/home/products-home.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$produktowa_data = get_field('sg-produktowa');

if (!$produktowa_data) {
    return;
}

$maly_naglowek = $produktowa_data['sg-produktowa-maly-naglowek'] ?? '';
$naglowek = $produktowa_data['sg-produktowa-naglowek'] ?? '';
$tekst = $produktowa_data['sg-produktowa-tekst'] ?? '';

// Lista kategorii do wyświetlenia
$kategorie = array(
    'Puch 95%',
    'Pierze',
    'Kulka silikonowa',
    'Aloe Vera',
    'Bamboo',
    'Gryka'
);

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($naglowek) && empty($kategorie)) {
    return;
}

// Generowanie unikalnego ID dla karuzeli
$carousel_id = 'products-carousel-' . uniqid();
?>

<section class="products-home" aria-labelledby="products-home-heading">
    <div class="products-home__top">
        <div class="container">
            <div class="products-home__intro">
                <div class="products-home__intro-left">
                    <?php if (!empty($maly_naglowek)) : ?>
                    <div class="products-home__subheading">
                        <?php echo wp_kses_post($maly_naglowek); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($naglowek)) : ?>
                    <h2 id="products-home-heading" class="products-home__heading">
                        <?php echo wp_kses_post($naglowek); ?>
                    </h2>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($tekst)) : ?>
                <div class="products-home__intro-right">
                    <div class="products-home__text">
                        <?php echo wp_kses_post($tekst); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <?php if (!empty($kategorie)) : ?>
    <div class="products-home__content">
        <div class="container">
            <div class="products-home__wrapper">
                <!-- Lewa kolumna z tabsami kategorii - widoczna tylko na desktop -->
                <div class="products-home__tabs" role="tablist" aria-label="Kategorie wypełnień">
                    <?php 
                    foreach ($kategorie as $index => $kategoria_nazwa) : 
                        $is_active = $index === 0 ? 'active' : '';
                        $tab_id = 'tab-' . sanitize_title($kategoria_nazwa);
                        $panel_id = 'panel-' . sanitize_title($kategoria_nazwa);
                        
                        // Pobierz ID kategorii po nazwie
                        $term = get_term_by('name', $kategoria_nazwa, 'product_cat');
                        if (!$term) continue;
                        
                        $term_id = $term->term_id;
                    ?>
                    <button 
                        id="<?php echo esc_attr($tab_id); ?>" 
                        class="products-home__tab <?php echo esc_attr($is_active); ?>"
                        aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                        aria-controls="<?php echo esc_attr($panel_id); ?>"
                        role="tab"
                        data-category="<?php echo esc_attr(sanitize_title($kategoria_nazwa)); ?>"
                        data-index="<?php echo esc_attr($index); ?>"
                    >
                        <span class="products-home__tab-text"><?php echo esc_html($kategoria_nazwa); ?></span>
                        <img 
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black2.svg'); ?>" 
                            class="products-home__tab-icon" 
                            alt="" 
                            aria-hidden="true"
                        >
                    </button>
                    <?php endforeach; ?>
                </div>
                
                <!-- Dropdown dla urządzeń mobilnych -->
                <div class="products-home__mobile-selector">
                    <div class="products-home__dropdown-wrapper">
                        <select class="products-home__mobile-dropdown" aria-label="Wybierz kategorię wypełnień">
                            <?php 
                            foreach ($kategorie as $index => $kategoria_nazwa) : 
                                $selected = $index === 0 ? 'selected' : '';
                                $category_slug = sanitize_title($kategoria_nazwa);
                            ?>
                            <option value="<?php echo esc_attr($category_slug); ?>" <?php echo $selected; ?>>
                                <?php echo esc_html($kategoria_nazwa); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="products-home__dropdown-icon">
                            <img 
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-down.svg'); ?>" 
                                alt="" 
                                aria-hidden="true"
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Prawa kolumna z kategoriami i produktami -->
                <div class="products-home__panels">
                    <?php 
                    foreach ($kategorie as $index => $kategoria_nazwa) : 
                        $term = get_term_by('name', $kategoria_nazwa, 'product_cat');
                        if (!$term) continue;
                        
                        $term_id = $term->term_id;
                        $term_slug = $term->slug;
                        $panel_id = 'panel-' . sanitize_title($kategoria_nazwa);
                        $tab_id = 'tab-' . sanitize_title($kategoria_nazwa);
                        
                        // Pobierz pola ACF dla kategorii
                        $banner = get_field('woo-banner', 'product_cat_' . $term_id);
                        $wlasciwosci = get_field('woo-wlasciwosci', 'product_cat_' . $term_id);
                        $temperatura = get_field('woo-temperatura', 'product_cat_' . $term_id);
                        $idealne_dla = get_field('woo-idealne_dla', 'product_cat_' . $term_id);
                        $pozycja_spania = get_field('woo-pozycja_spania', 'product_cat_' . $term_id);
                        
                        // Sprawdź, czy panel ma być widoczny
                        $is_hidden = $index !== 0 ? 'hidden' : '';
                        
                        // Pobierz link do kategorii
                        $category_link = get_term_link($term_id, 'product_cat');
                    ?>
                    <div 
                        id="<?php echo esc_attr($panel_id); ?>" 
                        class="products-home__panel <?php echo $index === 0 ? 'active' : ''; ?>"
                        role="tabpanel"
                        aria-labelledby="<?php echo esc_attr($tab_id); ?>"
                        data-category="<?php echo esc_attr(sanitize_title($kategoria_nazwa)); ?>"
                        <?php echo $is_hidden; ?>
                    >
                        <div class="products-home__panel-inner">
                            <!-- Kafelek kategorii na desktop -->
                            <div class="products-home__category-card products-home__category-card--desktop">
                                <?php if (!empty($banner)) : 
                                    // ACF zwraca ID jako int, nie array
                                    $banner_id = is_array($banner) ? $banner['ID'] : $banner;
                                    $banner_alt = get_post_meta($banner_id, '_wp_attachment_image_alt', true);
                                    if (empty($banner_alt)) {
                                        $banner_alt = sprintf(__('Kategoria: %s', 'pen-pol'), $kategoria_nazwa);
                                    }
                                ?>
                                <div class="products-home__category-image">
                                    <div class="products-home__category-overlay"></div>
                                    <?php 
                                    echo wp_get_attachment_image(
                                        $banner_id,
                                        'large',
                                        false,
                                        [
                                            'class' => 'products-home__category-banner',
                                            'alt' => esc_attr($banner_alt),
                                            'loading' => $index < 1 ? 'eager' : 'lazy',
                                            'decoding' => 'async',
                                            'fetchpriority' => $index < 1 ? 'high' : 'auto'
                                        ]
                                    );
                                    ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="products-home__category-link">
                                        <h3 class="products-home__category-title">
                                            <?php echo esc_html($kategoria_nazwa); ?>
                                            <img 
                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.svg'); ?>" 
                                                class="products-home__category-arrow" 
                                                alt="" 
                                                aria-hidden="true"
                                            >
                                        </h3>
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <div class="products-home__category-info">
                                    <?php if (!empty($wlasciwosci)) : ?>
                                    <div class="products-home__category-property">
                                        <h4 class="products-home__property-name">Właściwości</h4>
                                        <div class="products-home__property-value"><?php echo wp_kses_post($wlasciwosci); ?></div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($idealne_dla)) : ?>
                                    <div class="products-home__category-property">
                                        <h4 class="products-home__property-name">Idealne dla...</h4>
                                        <div class="products-home__property-value"><?php echo wp_kses_post($idealne_dla); ?></div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($temperatura)) : ?>
                                    <div class="products-home__category-property">
                                        <h4 class="products-home__property-name">Temperatura snu</h4>
                                        <div class="products-home__property-value"><?php echo wp_kses_post($temperatura); ?></div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($pozycja_spania)) : ?>
                                    <div class="products-home__category-property">
                                        <h4 class="products-home__property-name">Pozycja spania</h4>
                                        <div class="products-home__property-value"><?php echo wp_kses_post($pozycja_spania); ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Karuzela produktów -->
                            <div class="products-home__products-wrapper">
                                <div class="products-home__products-carousel swiper" id="<?php echo esc_attr($carousel_id . '-' . $term_slug); ?>">
                                    <div class="swiper-wrapper">
                                        <!-- Kafelek kategorii w karuzeli na mobile -->
                                        <div class="swiper-slide products-home__category-slide">
                                            <div class="products-home__category-card products-home__category-card--mobile">
                                                <?php if (!empty($banner)) : ?>
                                                <div class="products-home__category-image">
                                                    <div class="products-home__category-overlay"></div>
                                                    <?php 
                                                    echo wp_get_attachment_image(
                                                        $banner_id,
                                                        'large',
                                                        false,
                                                        [
                                                            'class' => 'products-home__category-banner',
                                                            'alt' => esc_attr($banner_alt),
                                                            'loading' => $index < 1 ? 'eager' : 'lazy',
                                                            'decoding' => 'async',
                                                            'fetchpriority' => $index < 1 ? 'high' : 'auto'
                                                        ]
                                                    );
                                                    ?>
                                                    <a href="<?php echo esc_url($category_link); ?>" class="products-home__category-link">
                                                        <h3 class="products-home__category-title">
                                                            <?php echo esc_html($kategoria_nazwa); ?>
                                                            <img 
                                                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.svg'); ?>" 
                                                                class="products-home__category-arrow" 
                                                                alt="" 
                                                                aria-hidden="true"
                                                            >
                                                        </h3>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <div class="products-home__category-info">
                                                    <?php if (!empty($wlasciwosci)) : ?>
                                                    <div class="products-home__category-property">
                                                        <h4 class="products-home__property-name">Właściwości</h4>
                                                        <div class="products-home__property-value"><?php echo wp_kses_post($wlasciwosci); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($idealne_dla)) : ?>
                                                    <div class="products-home__category-property">
                                                        <h4 class="products-home__property-name">Idealne dla...</h4>
                                                        <div class="products-home__property-value"><?php echo wp_kses_post($idealne_dla); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($temperatura)) : ?>
                                                    <div class="products-home__category-property">
                                                        <h4 class="products-home__property-name">Temperatura snu</h4>
                                                        <div class="products-home__property-value"><?php echo wp_kses_post($temperatura); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($pozycja_spania)) : ?>
                                                    <div class="products-home__category-property">
                                                        <h4 class="products-home__property-name">Pozycja spania</h4>
                                                        <div class="products-home__property-value"><?php echo wp_kses_post($pozycja_spania); ?></div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        // Pobierz 5 najnowszych produktów z danej kategorii
                                        $args = array(
                                            'post_type'      => 'product',
                                            'posts_per_page' => 5,
                                            'post_status'    => 'publish',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field'    => 'term_id',
                                                    'terms'    => $term_id,
                                                ),
                                            ),
                                            'orderby'        => 'date',
                                            'order'          => 'DESC',
                                        );
                                        
                                        $products = new WP_Query($args);
                                        
                                        if ($products->have_posts()) {
                                            while ($products->have_posts()) {
                                                $products->the_post();
                                                global $product;
                                        ?>
                                        <div class="swiper-slide">
                                            <?php wc_get_template_part('content', 'product'); ?>
                                        </div>
                                        <?php
                                            }
                                        } else {
                                            echo '<div class="products-home__no-products">' . esc_html__('Brak produktów w tej kategorii.', 'pen-pol') . '</div>';
                                        }
                                        
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Zmienne globalne
    const panels = document.querySelectorAll('.products-home__panel');
    const tabs = document.querySelectorAll('.products-home__tab');
    const mobileDropdown = document.querySelector('.products-home__mobile-dropdown');
    
    // Obiekt do przechowywania instancji Swiper
    const swiperInstances = {};
    
    // Funkcja do inicjalizacji Swipera w konkretnym panelu
    function initSwiperInPanel(panel) {
        const category = panel.dataset.category;
        const carousel = panel.querySelector('.products-home__products-carousel');
        
        if (!carousel) return;
        
        const carouselId = carousel.id;
        
        // Zniszcz istniejącą instancję, jeśli istnieje
        if (swiperInstances[carouselId]) {
            swiperInstances[carouselId].destroy(true, true);
            delete swiperInstances[carouselId];
        }
        
        // Upewnij się, że element jest widoczny przed inicjalizacją
        const wasHidden = panel.hidden;
        if (wasHidden) {
            // Tymczasowo pokaż panel, ale ukryj go za pomocą CSS
            panel.hidden = false;
            panel.style.visibility = 'hidden';
            panel.style.position = 'absolute';
            panel.style.opacity = '0';
        }
        
        // Inicjalizuj nową instancję Swiper
        swiperInstances[carouselId] = new Swiper(carousel, {
            // Podstawowe ustawienia
            slidesPerView: 1.25,
            spaceBetween: 20,
            loop: true,
            loopedSlides: 6,
            loopFillGroupWithBlank: false,
            loopAdditionalSlides: 2,
            initialSlide: 0,
            grabCursor: true,
            watchSlidesProgress: true,
            
            // Breakpointy
            breakpoints: {
                480: {
                    slidesPerView: 1.25,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2.5,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 2.5,
                    spaceBetween: 20,
                }
            },
            
            on: {
                init: function() {
                    // Ustaw pozycję po inicjalizacji
                    this.slideToLoop(0, 0, false);
                }
            },
            
            a11y: {
                enabled: true,
                prevSlideMessage: 'Poprzedni produkt',
                nextSlideMessage: 'Następny produkt',
                firstSlideMessage: 'Pierwszy produkt',
                lastSlideMessage: 'Ostatni produkt',
                paginationBulletMessage: 'Przejdź do produktu {{index}}',
                notificationClass: 'swiper-notification',
                containerMessage: 'Karuzela produktów',
                containerRoleDescriptionMessage: 'karuzela',
                itemRoleDescriptionMessage: 'slajd'
            }
        });
        
        // Przywróć ukryty stan, jeśli był wcześniej ukryty
        if (wasHidden) {
            panel.style.visibility = '';
            panel.style.position = '';
            panel.style.opacity = '';
            panel.hidden = true;
        }
        
        // Dodatkowa aktualizacja po pełnym załadowaniu
        setTimeout(() => {
            if (swiperInstances[carouselId]) {
                swiperInstances[carouselId].update();
            }
        }, 100);
        
        return swiperInstances[carouselId];
    }
    
    // Inicjalizacja pierwszego taba i jego Swipera
    function initFirstTab() {
        if (tabs.length > 0) {
            const firstTab = tabs[0];
            const firstCategory = firstTab.dataset.category;
            
            // Aktywuj pierwszy tab
            firstTab.classList.add('active');
            firstTab.setAttribute('aria-selected', 'true');
            
            // Pokaż pierwszy panel i inicjalizuj jego Swiper
            panels.forEach(panel => {
                const isFirstPanel = panel.dataset.category === firstCategory;
                panel.classList.toggle('active', isFirstPanel);
                panel.hidden = !isFirstPanel;
                
                if (isFirstPanel) {
                    initSwiperInPanel(panel);
                }
            });
            
            // Ustaw dropdown na pierwszą kategorię
            if (mobileDropdown) {
                mobileDropdown.value = firstCategory;
            }
        }
    }
    
    // Funkcja do obsługi zmiany taba
    function handleTabChange(categoryId) {
        // Ukryj wszystkie panele
        panels.forEach(panel => {
            panel.classList.remove('active');
            panel.hidden = true;
        });
        
        // Pokaż odpowiedni panel
        const activePanel = document.querySelector(`.products-home__panel[data-category="${categoryId}"]`);
        if (activePanel) {
            activePanel.classList.add('active');
            activePanel.hidden = false;
            
            // Inicjalizuj Swiper dla aktywnego panelu, jeśli jeszcze nie istnieje
            const carousel = activePanel.querySelector('.products-home__products-carousel');
            if (carousel) {
                const carouselId = carousel.id;
                if (!swiperInstances[carouselId]) {
                    initSwiperInPanel(activePanel);
                } else {
                    // Aktualizuj istniejący Swiper z opóźnieniem
                    setTimeout(() => {
                        swiperInstances[carouselId].update();
                        swiperInstances[carouselId].slideToLoop(0, 0, false);
                    }, 50);
                }
            }
        }
        
        // Aktualizuj widoczność tabów
        tabs.forEach(tab => {
            const isSelected = tab.dataset.category === categoryId;
            tab.classList.toggle('active', isSelected);
            tab.setAttribute('aria-selected', isSelected ? 'true' : 'false');
        });
        
        // Synchronizuj dropdown
        if (mobileDropdown) {
            mobileDropdown.value = categoryId;
        }
    }
    
    // Obsługa przełączania tabów
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;
            const isActive = this.classList.contains('active');
            
            if (isActive) return;
            
            handleTabChange(category);
        });
    });
    
    // Obsługa dropdowna
    if (mobileDropdown) {
        // Animacja przy otwieraniu/zamykaniu
        mobileDropdown.addEventListener('focus', function() {
            const dropdownIcon = document.querySelector('.products-home__dropdown-icon img');
            if (dropdownIcon) {
                dropdownIcon.classList.add('rotate');
            }
        });
        
        mobileDropdown.addEventListener('blur', function() {
            const dropdownIcon = document.querySelector('.products-home__dropdown-icon img');
            if (dropdownIcon) {
                dropdownIcon.classList.remove('rotate');
            }
        });
        
        // Obsługa zmiany wartości
        mobileDropdown.addEventListener('change', function() {
            const selectedCategory = this.value;
            handleTabChange(selectedCategory);
        });
    }
    
    // Obsługa zmiany rozmiaru okna
    window.addEventListener('resize', function() {
        // Pobierz aktualnie aktywny panel
        const activePanel = document.querySelector('.products-home__panel.active');
        if (activePanel) {
            const carousel = activePanel.querySelector('.products-home__products-carousel');
            if (carousel) {
                const carouselId = carousel.id;
                if (swiperInstances[carouselId]) {
                    // Aktualizuj tylko aktywny Swiper
                    swiperInstances[carouselId].update();
                }
            }
        }
    });
    
    // Inicjalizacja tylko pierwszego taba, pozostałe będą inicjalizowane przy przełączaniu
    initFirstTab();
    
    // Przed-inicjalizacja pozostałych paneli (opcjonalne, można usunąć)
    // setTimeout(() => {
    //     panels.forEach(panel => {
    //         if (!panel.classList.contains('active')) {
    //             initSwiperInPanel(panel);
    //         }
    //     });
    // }, 1000);
});
</script>