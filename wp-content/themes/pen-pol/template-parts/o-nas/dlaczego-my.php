<?php
/**
 * Template Part: Why Us Section
 * 
 * Displays the "Dlaczego my" section with heading, subheading, images and info cards
 * Uses ACF fields: o_nas-dlaczego_my group
 * Location: template-parts/why-us.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$why_us_data = get_field('o_nas-dlaczego_my');

if (!$why_us_data) {
    return;
}

$subheading = $why_us_data['o_nas-dlaczego_my-subnaglowek'] ?? '';
$heading = $why_us_data['o_nas-dlaczego_my-naglowek'] ?? '';
$image1 = $why_us_data['o_nas-dlaczego_my-obrazek1'] ?? null;
$image2 = $why_us_data['o_nas-dlaczego_my-obrazek2'] ?? null;
$cards = $why_us_data['o_nas-dlaczego_my-karty'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($heading) && empty($subheading) && empty($image1) && empty($cards)) {
    return;
}
?>

<section class="why-us" aria-labelledby="why-us-heading">
    <div class="why-us__container">
        
        <?php if (!empty($heading) || !empty($subheading) || !empty($image1) || !empty($image2)) : ?>
        <div class="why-us__top">
            
            <?php if (!empty($heading) || !empty($subheading)) : ?>
            <div class="why-us__content">
                <?php if (!empty($subheading)) : ?>
                <p class="why-us__subheading">
                    <?php echo wp_kses_post($subheading); ?>
                </p>
                <?php endif; ?>
                
                <?php if (!empty($heading)) : ?>
                <h2 id="why-us-heading" class="why-us__heading">
                    <?php echo wp_kses_post($heading); ?>
                </h2>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($image1) || !empty($image2)) : ?>
            <div class="why-us__images">
                <?php if (!empty($image1)) : 
                    $image1_id = is_array($image1) ? $image1['ID'] : $image1;
                    $image1_alt = get_post_meta($image1_id, '_wp_attachment_image_alt', true);
                    if (empty($image1_alt)) {
                        $image1_alt = __('Dlaczego my - zdjęcie 1', 'pen-pol');
                    }
                ?>
                <div class="why-us__image-wrapper why-us__image-wrapper--top">
                    <?php echo wp_get_attachment_image(
                        $image1_id,
                        'medium_large',
                        false,
                        [
                            'class' => 'why-us__image',
                            'alt' => esc_attr($image1_alt),
                            'loading' => 'lazy',
                            'decoding' => 'async'
                        ]
                    ); ?>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($image2)) : 
                    $image2_id = is_array($image2) ? $image2['ID'] : $image2;
                    $image2_alt = get_post_meta($image2_id, '_wp_attachment_image_alt', true);
                    if (empty($image2_alt)) {
                        $image2_alt = __('Dlaczego my - zdjęcie 2', 'pen-pol');
                    }
                ?>
                <div class="why-us__image-wrapper why-us__image-wrapper--bottom">
                    <?php echo wp_get_attachment_image(
                        $image2_id,
                        'medium_large',
                        false,
                        [
                            'class' => 'why-us__image',
                            'alt' => esc_attr($image2_alt),
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
        
        <?php if (!empty($cards) && is_array($cards)) : ?>
        <div class="why-us__bottom">
            <div class="why-us__grid">
                <?php 
                foreach ($cards as $index => $card) : 
                    if (!is_array($card)) {
                        continue;
                    }
                    
                    $icon = $card['o_nas-dlaczego_my-karty-ikonka'] ?? null;
                    $card_title = $card['o_nas-dlaczego_my-karty-naglowek'] ?? '';
                    $card_text = $card['o_nas-dlaczego_my-karty-opis'] ?? '';
                    
                    if (empty($card_title) && empty($card_text) && empty($icon)) {
                        continue;
                    }
                    
                    $card_id = 'why-us-card-' . ($index + 1);
                ?>
                <div class="why-us__card" id="<?php echo esc_attr($card_id); ?>">
                    <div class="why-us__card-header">
                        <?php if (!empty($icon)) : 
                            $icon_id = is_array($icon) ? $icon['ID'] : $icon;
                            $icon_alt = get_post_meta($icon_id, '_wp_attachment_image_alt', true);
                            if (empty($icon_alt)) {
                                $icon_alt = sprintf(__('Ikona: %s', 'pen-pol'), $card_title);
                            }
                        ?>
                        <div class="why-us__icon-wrapper">
                            <?php echo wp_get_attachment_image(
                                $icon_id,
                                'thumbnail',
                                false,
                                [
                                    'class' => 'why-us__icon',
                                    'alt' => esc_attr($icon_alt),
                                    'loading' => 'lazy',
                                    'decoding' => 'async',
                                    'width' => '40',
                                    'height' => '40'
                                ]
                            ); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($card_title)) : ?>
                        <h3 class="why-us__card-title">
                            <?php echo wp_kses_post($card_title); ?>
                        </h3>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($card_text)) : ?>
                    <div class="why-us__card-text">
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