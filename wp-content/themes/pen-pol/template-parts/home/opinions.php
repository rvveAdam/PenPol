<?php
/**
 * Template Part: Opinie (Testimonials Section)
 * 
 * Displays customer testimonials in a carousel
 * Uses ACF fields: sg_opinie group
 * Location: template-parts/home/opinie.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$opinie_data = get_field('sg_opinie');

if (!$opinie_data) {
    return;
}

$naglowek = $opinie_data['sg_opinie-naglowek'] ?? '';
$opinie = $opinie_data['sg_opinie-pp'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($opinie)) {
    return;
}

// Generowanie unikalnego ID dla karuzeli
$carousel_id = 'opinie-carousel-' . uniqid();
?>

<section class="opinie-wrapper" aria-labelledby="opinie-heading">
    <div class="opinie-container">
        <?php if (!empty($naglowek)) : ?>
        <div class="opinie-header">
            <h2 id="opinie-heading" class="opinie-header__heading">
                <?php echo wp_kses_post($naglowek); ?>
            </h2>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($opinie)) : ?>
        <div class="opinie-content">
            <div class="opinie-carousel swiper" id="<?php echo esc_attr($carousel_id); ?>">
                <div class="swiper-wrapper">
                    <?php 
                    foreach ($opinie as $index => $opinia) : 
                        $tresc_opinii = $opinia['sg_opinie-pp-tresc_opinii'] ?? '';
                        $imie = $opinia['sg_opinie-pp-imie'] ?? '';
                        
                        if (empty($tresc_opinii) && empty($imie)) continue;
                    ?>
                    <div class="opinie-carousel__slide swiper-slide">
                        <div class="opinie-carousel__card">
                            <div class="opinie-carousel__icon">
                                <img 
                                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/opinie-icon.svg'); ?>" 
                                    alt="" 
                                    aria-hidden="true"
                                >
                            </div>
                            
                            <?php if (!empty($tresc_opinii)) : ?>
                            <div class="opinie-carousel__text">
                                <?php echo wp_kses_post($tresc_opinii); ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="opinie-carousel__footer">
                                <?php if (!empty($imie)) : ?>
                                <div class="opinie-carousel__author">
                                    <div class="opinie-carousel__name"><?php echo esc_html($imie); ?></div>
                                    <div class="opinie-carousel__role"><?php echo esc_html__('Kupujący', 'pen-pol'); ?></div>
                                </div>
                                <?php endif; ?>
                                
                                <div class="opinie-carousel__rating" aria-label="<?php echo esc_attr__('5 z 5 gwiazdek', 'pen-pol'); ?>">
                                    <img 
                                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/rating-stars-opinie.svg'); ?>" 
                                        alt="" 
                                        class="opinie-carousel__stars-image" 
                                        aria-hidden="true"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>