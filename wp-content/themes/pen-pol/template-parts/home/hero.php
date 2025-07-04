<?php
/**
 * Template part for displaying Hero section
 * 
 * WCAG 2.1 AA compliant hero slider with BEM methodology
 * Container-based layout with border-radius and shadow
 * Mobile optimized with separate mobile images
 * Compatible with WordPress 6.x and WooCommerce 8.x+
 *
 * @package Pen-pol
 * @since 1.0.0
 */

// Security check
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get and validate hero slides data from ACF
 *
 * @return array|false Hero slides data or false if invalid
 */
function pen_pol_get_hero_slides() {
    $hero_group = get_field('sg-hero');
    $hero_slides = $hero_group['sg-hero_slajder'] ?? [];
    
    // Validate slides data
    if (!is_array($hero_slides) || empty($hero_slides)) {
        return false;
    }
    
    return $hero_slides;
}

// Get hero slides data
$hero_slides = pen_pol_get_hero_slides();

// Early return if no slides
if (!$hero_slides) {
    return;
}

// Determine if single slide
$is_single_slide = count($hero_slides) === 1;
$hero_modifier = $is_single_slide ? ' hero--single' : ' hero--slider';

// Generate unique section ID for skip link and ARIA
$section_id = 'hero-section-' . wp_unique_id();
?>

<section class="hero-wrapper" 
         id="<?php echo esc_attr($section_id); ?>" 
         aria-label="<?php esc_attr_e('Hero banner', 'pen-pol'); ?>">
    
    <?php if (!$is_single_slide): ?>
        <!-- Skip link for keyboard users -->
        <a href="#main-content" class="skip-link">
            <?php esc_html_e('Przejdź do treści głównej', 'pen-pol'); ?>
        </a>
    <?php endif; ?>
    
    <div class="hero-container">
        <div class="hero<?php echo esc_attr($hero_modifier); ?>">
            <div class="hero__slider<?php echo !$is_single_slide ? ' swiper' : ''; ?>" 
             <?php if (!$is_single_slide): ?>
                 aria-label="<?php esc_attr_e('Karuzela obrazów', 'pen-pol'); ?>"
                 aria-live="polite"
             <?php endif; ?>>
            
            <div class="<?php echo !$is_single_slide ? 'swiper-wrapper' : 'hero__slides'; ?>">
                <?php foreach ($hero_slides as $index => $slide): ?>
                    <?php
                    // Sanitize and validate slide data
                    $slide_data = [
                        'image_id' => absint($slide['sg-hero_slajder_obrazek'] ?? 0),
                        'image_mobile_id' => absint($slide['sg-hero_slajder_obrazek_mobile'] ?? 0),
                        'title_main' => sanitize_text_field($slide['sg-hero_slajder_naglowek-main'] ?? ''),
                        'title_accent' => sanitize_text_field($slide['sg-hero_slajder_naglowek-akcent'] ?? ''),
                        'text' => wp_kses_post($slide['sg-hero_slajder_tekst'] ?? ''),
                        'button_url' => esc_url_raw($slide['sg-hero_slajder_button_url'] ?? ''),
                        'button_text' => __('Odkryj wszystkie kategorie', 'pen-pol') // Domyślny tekst przycisku
                    ];
                    
                    // Get desktop image URL and alt
                    $image_url = wp_get_attachment_image_url($slide_data['image_id'], 'full');
                    $image_alt = get_post_meta($slide_data['image_id'], '_wp_attachment_image_alt', true);
                    
                    // Get mobile image URL (fallback to desktop if not provided)
                    $mobile_image_id = $slide_data['image_mobile_id'] ?: $slide_data['image_id'];
                    $mobile_image_url = wp_get_attachment_image_url($mobile_image_id, 'full');
                    $mobile_image_alt = get_post_meta($mobile_image_id, '_wp_attachment_image_alt', true);
                    
                    // Fallback alt text
                    if (empty($image_alt)) {
                        $image_alt = sprintf(__('Zdjęcie: %s', 'pen-pol'), $slide_data['title_main']);
                    }
                    if (empty($mobile_image_alt)) {
                        $mobile_image_alt = sprintf(__('Zdjęcie mobilne: %s', 'pen-pol'), $slide_data['title_main']);
                    }
                    
                    // Generate slide ID for accessibility
                    $slide_id = 'hero-slide-' . ($index + 1);
                    ?>
                    
                    <div class="<?php echo !$is_single_slide ? 'swiper-slide' : 'hero__slide-wrapper'; ?>" 
                         <?php if (!$is_single_slide): ?>
                             aria-label="<?php printf(esc_attr__('Slajd %d z %d', 'pen-pol'), $index + 1, count($hero_slides)); ?>"
                             id="<?php echo esc_attr($slide_id); ?>"
                         <?php endif; ?>>
                        
                        <article class="hero__slide<?php echo $index === 0 ? ' hero__slide--active' : ''; ?>">
                            <!-- Background with responsive images and overlay -->
                            <div class="hero__background">
                                <!-- Desktop image -->
                                <?php if ($image_url): ?>
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="<?php echo esc_attr($image_alt); ?>" 
                                         class="hero__image hero__image--desktop"
                                         loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                                         width="1920" 
                                         height="1080">
                                <?php endif; ?>
                                
                                <!-- Mobile image -->
                                <?php if ($mobile_image_url): ?>
                                    <img src="<?php echo esc_url($mobile_image_url); ?>" 
                                         alt="<?php echo esc_attr($mobile_image_alt); ?>" 
                                         class="hero__image hero__image--mobile"
                                         loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                                         width="768" 
                                         height="1024">
                                <?php endif; ?>
                                
                                <div class="hero__overlay" aria-hidden="true"></div>
                            </div>
                            
                            <!-- Content area -->
                            <div class="hero__content">
                                <div class="container">
                                    <div class="hero__wrapper">
                                        <!-- Header section with title and navigation -->
                                        <header class="hero__header">
                                            <div class="hero__text-content">
                                                <?php if ($slide_data['title_main'] || $slide_data['title_accent']): ?>
                                                    <h1 class="hero__title">
                                                        <?php if ($slide_data['title_main']): ?>
                                                            <span class="hero__title-main">
                                                                <?php echo esc_html($slide_data['title_main']); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <?php if ($slide_data['title_accent']): ?>
                                                            <span class="hero__title-accent">
                                                                <?php echo esc_html($slide_data['title_accent']); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </h1>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!$is_single_slide): ?>
                                                <nav class="hero__navigation">
                                                    <button class="hero__nav-button hero__nav-button--prev" 
                                                            aria-label="<?php esc_attr_e('Poprzedni slajd', 'pen-pol'); ?>"
                                                            type="button">
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left.svg'); ?>" alt="" aria-hidden="true">
                                                    </button>
                                                    <button class="hero__nav-button hero__nav-button--next" 
                                                            aria-label="<?php esc_attr_e('Następny slajd', 'pen-pol'); ?>"
                                                            type="button">
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.svg'); ?>" alt="" aria-hidden="true">
                                                    </button>
                                                </nav>
                                            <?php endif; ?>
                                        </header>
                                        
                                        <!-- Body section with description and CTA -->
                                        <div class="hero__body">
                                            <div class="hero__text-content">
                                                <?php if ($slide_data['text']): ?>
                                                    <div class="hero__description">
                                                        <p><?php echo wp_kses_post($slide_data['text']); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="hero__controls">
                                                <?php if ($slide_data['button_url']): ?>
                                                    <a href="<?php echo esc_url($slide_data['button_url']); ?>" 
                                                       class="btn btn--link btn--link--light">
                                                        <span class="btn__text">
                                                            <?php echo esc_html($slide_data['button_text']); ?>
                                                        </span>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-top_right.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</section>