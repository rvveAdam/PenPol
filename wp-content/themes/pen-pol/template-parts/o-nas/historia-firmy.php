<?php
/**
 * Template Part: Historia Firmy
 * 
 * Displays the "Historia firmy" section with text content and archive images
 * Uses ACF fields: o_nas-historia group
 * Location: template-parts/historia-firmy.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$historia_data = get_field('o_nas-historia');

if (!$historia_data) {
    return;
}

$subheading = $historia_data['o_nas-historia-subnaglowek'] ?? '';
$heading = $historia_data['o_nas-historia-naglowek'] ?? '';
$description = $historia_data['o_nas-historia-opis'] ?? '';
$image1 = $historia_data['o_nas-historia-obrazek_1'] ?? null;
$image2 = $historia_data['o_nas-historia-obrazek_2'] ?? null;
$image3 = $historia_data['o_nas-historia-obrazek_3'] ?? null;
$image4 = $historia_data['o_nas-historia-obrazek_4'] ?? null;

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($heading) && empty($description) && empty($image1) && empty($image2) && empty($image3) && empty($image4)) {
    return;
}
?>

<section class="history" aria-labelledby="history-heading">
    <div class="history__container">
        <div class="history__content">
            <?php if (!empty($subheading)) : ?>
            <div class="history__subheading">
                <?php echo wp_kses_post($subheading); ?>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($heading)) : ?>
            <h2 id="history-heading" class="history__heading">
                <?php echo wp_kses_post($heading); ?>
            </h2>
            <?php endif; ?>
            
            <?php if (!empty($description)) : ?>
            <div class="history__description">
                <?php echo wp_kses_post($description); ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="history__images">
            <div class="history__images-container">
                <div class="history__images-left">
                    <?php if (!empty($image1)) : 
                        $image1_id = is_array($image1) ? $image1['ID'] : $image1;
                        $image1_alt = get_post_meta($image1_id, '_wp_attachment_image_alt', true);
                        if (empty($image1_alt)) {
                            $image1_alt = __('Historia firmy - zdjęcie archiwalne', 'pen-pol');
                        }
                    ?>
                    <div class="history__image-wrapper history__image-wrapper--1">
                        <?php echo wp_get_attachment_image(
                            $image1_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'history__image',
                                'alt' => esc_attr($image1_alt),
                                'loading' => 'eager',
                                'decoding' => 'async',
                                'fetchpriority' => 'high'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($image2)) : 
                        $image2_id = is_array($image2) ? $image2['ID'] : $image2;
                        $image2_alt = get_post_meta($image2_id, '_wp_attachment_image_alt', true);
                        if (empty($image2_alt)) {
                            $image2_alt = __('Historia firmy - zdjęcie archiwalne', 'pen-pol');
                        }
                    ?>
                    <div class="history__image-wrapper history__image-wrapper--2">
                        <?php echo wp_get_attachment_image(
                            $image2_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'history__image',
                                'alt' => esc_attr($image2_alt),
                                'loading' => 'lazy',
                                'decoding' => 'async'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="history__images-right">
                    <?php if (!empty($image3)) : 
                        $image3_id = is_array($image3) ? $image3['ID'] : $image3;
                        $image3_alt = get_post_meta($image3_id, '_wp_attachment_image_alt', true);
                        if (empty($image3_alt)) {
                            $image3_alt = __('Historia firmy - zdjęcie archiwalne', 'pen-pol');
                        }
                    ?>
                    <div class="history__image-wrapper history__image-wrapper--3">
                        <?php echo wp_get_attachment_image(
                            $image3_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'history__image',
                                'alt' => esc_attr($image3_alt),
                                'loading' => 'lazy',
                                'decoding' => 'async'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($image4)) : 
                        $image4_id = is_array($image4) ? $image4['ID'] : $image4;
                        $image4_alt = get_post_meta($image4_id, '_wp_attachment_image_alt', true);
                        if (empty($image4_alt)) {
                            $image4_alt = __('Historia firmy - zdjęcie archiwalne', 'pen-pol');
                        }
                    ?>
                    <div class="history__image-wrapper history__image-wrapper--4">
                        <?php echo wp_get_attachment_image(
                            $image4_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'history__image',
                                'alt' => esc_attr($image4_alt),
                                'loading' => 'lazy',
                                'decoding' => 'async'
                            ]
                        ); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>