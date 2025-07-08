<?php
/**
 * Template Part: About Us Section
 * 
 * Displays the "O nas" section with text content, images and info cards
 * Uses ACF fields: sg-o_nas group
 * Location: template-parts/o-nas.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$about_data = get_field('sg-o_nas');

if (!$about_data) {
    return;
}

$heading = $about_data['sg-o_nas-naglowek'] ?? '';
$text = $about_data['sg-o_nas-tekst'] ?? '';
$image1 = $about_data['sg-o_nas-obrazek1'] ?? null;
$image2 = $about_data['sg-o_nas-obrazek2'] ?? null;
$image3 = $about_data['sg-o_nas-obrazek3'] ?? null;
$info_cards = $about_data['sg-o_nas-kafelki_informacyjne'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($heading) && empty($text) && empty($image1) && empty($info_cards)) {
    return;
}
?>

<section class="about" aria-labelledby="about-heading">
    <div class="about__container">
        
        <?php if (!empty($heading) || !empty($text) || !empty($image1)) : ?>
        <div class="about__top">
            
            <?php if (!empty($heading) || !empty($text)) : ?>
            <div class="about__content">
                <?php if (!empty($heading)) : ?>
                <h2 id="about-heading" class="about__heading">
                    <?php echo wp_kses_post($heading); ?>
                </h2>
                <?php endif; ?>
                
                <?php if (!empty($text)) : ?>
                <div class="about__text">
                    <?php echo wp_kses_post($text); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($image1) || !empty($image2) || !empty($image3)) : ?>
            <div class="about__images">
                <!-- Lewa kolumna z głównym obrazkiem -->
                <?php if (!empty($image1)) : 
                    $image1_id = is_array($image1) ? $image1['ID'] : $image1;
                    $image1_alt = get_post_meta($image1_id, '_wp_attachment_image_alt', true);
                    if (empty($image1_alt)) {
                        $image1_alt = __('O nas - główne zdjęcie', 'pen-pol');
                    }
                ?>
                <div class="about__image-column about__image-column--left">
                    <div class="about__image-wrapper">
                        <?php echo wp_get_attachment_image(
                            $image1_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'about__image',
                                'alt' => esc_attr($image1_alt),
                                'loading' => 'eager',
                                'decoding' => 'async',
                                'fetchpriority' => 'high'
                            ]
                        ); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Prawa kolumna z dwoma obrazkami, jeden pod drugim -->
                <?php if (!empty($image2) || !empty($image3)) : ?>
                <div class="about__image-column about__image-column--right">
                    <?php if (!empty($image2)) : 
                        $image2_id = is_array($image2) ? $image2['ID'] : $image2;
                        $image2_alt = get_post_meta($image2_id, '_wp_attachment_image_alt', true);
                        if (empty($image2_alt)) {
                            $image2_alt = __('O nas - zdjęcie dodatkowe', 'pen-pol');
                        }
                    ?>
                    <div class="about__image-wrapper">
                        <?php echo wp_get_attachment_image(
                            $image2_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'about__image',
                                'alt' => esc_attr($image2_alt),
                                'loading' => 'lazy',
                                'decoding' => 'async'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($image3)) : 
                        $image3_id = is_array($image3) ? $image3['ID'] : $image3;
                        $image3_alt = get_post_meta($image3_id, '_wp_attachment_image_alt', true);
                        if (empty($image3_alt)) {
                            $image3_alt = __('O nas - zdjęcie dodatkowe', 'pen-pol');
                        }
                    ?>
                    <div class="about__image-wrapper">
                        <?php echo wp_get_attachment_image(
                            $image3_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'about__image',
                                'alt' => esc_attr($image3_alt),
                                'loading' => 'lazy',
                                'decoding' => 'async'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
        </div>
        <?php endif; ?>
        
        <?php if (!empty($info_cards)) : ?>
        <div class="about__bottom">
            <div class="about__cards">
                <?php 
                foreach ($info_cards as $index => $card) : 
                    $card_title = $card['sg-o_nas-kafelki_informacyjne-naglowek'] ?? '';
                    $card_text = $card['sg-o_nas-kafelki_informacyjne-tekst'] ?? '';
                    
                    if (empty($card_title) && empty($card_text)) {
                        continue;
                    }
                    
                    // Zmienianie koloru co drugi kafelek (nieparzyste niebieskie, parzyste białe)
                    $card_class = ($index % 2 === 0) ? 'about__card--blue' : 'about__card--white';
                    $card_id = 'about-card-' . ($index + 1);
                ?>
                <div class="about__card <?php echo esc_attr($card_class); ?>" id="<?php echo esc_attr($card_id); ?>">
                    <?php if (!empty($card_title)) : ?>
                    <h3 class="about__card-title">
                        <?php echo wp_kses_post($card_title); ?>
                    </h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($card_text)) : ?>
                    <div class="about__card-text">
                        <?php echo wp_kses_post($card_text); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</section>