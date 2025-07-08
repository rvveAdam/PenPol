<?php
/**
 * Template Part: Poradniki (Sleeping Guides Section)
 * 
 * Displays accordion with different sleeping positions and advice
 * Uses ACF fields: sg-rodzaje_spania group
 * Location: template-parts/home/poradniki.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$spanie_data = get_field('sg-rodzaje_spania');

if (!$spanie_data) {
    return;
}

$naglowek = $spanie_data['sg-rodzaje_spania-naglowek'] ?? '';
$tekst_naglowek = $spanie_data['sg-rodzaje_spania-tekst-naglowek'] ?? '';
$tekst_opisowy = $spanie_data['sg-rodzaje_spania-tekst'] ?? '';
$rodzaje_spania = $spanie_data['sg-rodzaje_spania-content'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($naglowek) && empty($rodzaje_spania)) {
    return;
}

// Generowanie unikalnego ID dla akordeonu
$accordion_id = 'spanie-accordion-' . uniqid();
?>

<section class="poradniki-wrapper" aria-labelledby="poradniki-heading">
    <div class="poradniki-container">
        <?php if (!empty($naglowek) || !empty($tekst_naglowek) || !empty($tekst_opisowy)) : ?>
        <div class="poradniki-header">
            <div class="poradniki-header__left">
                <?php if (!empty($naglowek)) : ?>
                <h2 id="poradniki-heading" class="poradniki-header__heading">
                    <?php echo wp_kses_post($naglowek); ?>
                </h2>
                <?php endif; ?>
                
                <?php if (!empty($tekst_naglowek)) : ?>
                <div class="poradniki-header__subheading">
                    <?php echo wp_kses_post($tekst_naglowek); ?>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($tekst_opisowy)) : ?>
            <div class="poradniki-header__right">
                <div class="poradniki-header__text">
                    <?php echo wp_kses_post($tekst_opisowy); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($rodzaje_spania)) : ?>
        <div class="poradniki-content">
            <div class="poradniki-accordion">
                <div class="poradniki-accordion__headers" role="tablist" aria-label="Rodzaje spania">
                    <?php 
                    foreach ($rodzaje_spania as $index => $rodzaj) : 
                        $naglowek_rodzaju = $rodzaj['sg-rodzaje_spania-content-naglowek'] ?? '';
                        if (empty($naglowek_rodzaju)) continue;
                        
                        $is_active = $index === 0 ? 'active' : '';
                        $tab_id = 'tab-' . sanitize_title($naglowek_rodzaju) . '-' . $index;
                        $panel_id = 'panel-' . sanitize_title($naglowek_rodzaju) . '-' . $index;
                    ?>
                    <button 
                        id="<?php echo esc_attr($tab_id); ?>" 
                        class="poradniki-accordion__tab <?php echo esc_attr($is_active); ?>"
                        aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                        aria-controls="<?php echo esc_attr($panel_id); ?>"
                        role="tab"
                        data-index="<?php echo esc_attr($index); ?>"
                    >
                        <span class="poradniki-accordion__tab-text"><?php echo esc_html($naglowek_rodzaju); ?></span>
                        <img 
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_pointing-right--black.svg'); ?>" 
                            class="poradniki-accordion__tab-icon" 
                            alt="" 
                            aria-hidden="true"
                        >
                    </button>
                    <?php endforeach; ?>
                </div>
                
                <div class="poradniki-accordion__panels swiper" id="<?php echo esc_attr($accordion_id); ?>">
                    <div class="swiper-wrapper">
                        <?php 
                        foreach ($rodzaje_spania as $index => $rodzaj) : 
                            $naglowek_rodzaju = $rodzaj['sg-rodzaje_spania-content-naglowek'] ?? '';
                            $tekst_rodzaju = $rodzaj['sg-rodzaje_spania-content-tekst'] ?? '';
                            $obrazek_rodzaju = $rodzaj['sg-rodzaje_spania-content-obrazek'] ?? null;
                            $button_url = $rodzaj['sg-rodzaje_spania-content-buttonURL'] ?? '';
                            
                            if (empty($naglowek_rodzaju)) continue;
                            
                            $panel_id = 'panel-' . sanitize_title($naglowek_rodzaju) . '-' . $index;
                            $tab_id = 'tab-' . sanitize_title($naglowek_rodzaju) . '-' . $index;
                            
                            // Określamy czy panel ma obrazek
                            $has_image = !empty($obrazek_rodzaju);
                        ?>
                        <div 
                            id="<?php echo esc_attr($panel_id); ?>" 
                            class="poradniki-accordion__panel swiper-slide"
                            role="tabpanel"
                            aria-labelledby="<?php echo esc_attr($tab_id); ?>"
                            <?php echo $index !== 0 ? 'hidden' : ''; ?>
                            data-index="<?php echo esc_attr($index); ?>"
                        >
                            <?php if ($has_image) : 
                                // ACF zwraca ID jako int, nie array
                                $image_id = is_array($obrazek_rodzaju) ? $obrazek_rodzaju['ID'] : $obrazek_rodzaju;
                                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                if (empty($image_alt)) {
                                    $image_alt = sprintf(__('Pozycja spania: %s', 'pen-pol'), $naglowek_rodzaju);
                                }
                            ?>
                            <div class="poradniki-accordion__panel-background">
                                <?php 
                                echo wp_get_attachment_image(
                                    $image_id,
                                    'large',
                                    false,
                                    [
                                        'class' => 'poradniki-accordion__panel-image',
                                        'alt' => esc_attr($image_alt),
                                        'loading' => $index < 1 ? 'eager' : 'lazy', // Tylko pierwszy ładowany eager
                                        'decoding' => 'async',
                                        'fetchpriority' => $index < 1 ? 'high' : 'auto' // Priorytet dla pierwszego obrazka
                                    ]
                                );
                                ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="poradniki-accordion__panel-overlay"></div>
                            
                            <div class="poradniki-accordion__panel-content">
                                <div class="poradniki-accordion__panel-spacer"></div>
                                
                                <?php if (!empty($button_url)) : ?>
                                <div class="poradniki-accordion__panel-cta">
                                    <a href="<?php echo esc_url($button_url); ?>" 
                                       class="btn btn--link btn--link--light"
                                       aria-describedby="<?php echo esc_attr($tab_id); ?>">
                                        <span class="btn__text">Odkryj wszystkie kategorie</span>
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-top_right.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                                    </a>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($tekst_rodzaju)) : ?>
                                <div class="poradniki-accordion__panel-text">
                                    <?php echo wp_kses_post($tekst_rodzaju); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>