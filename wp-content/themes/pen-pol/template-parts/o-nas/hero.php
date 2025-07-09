<?php
/**
 * Template part for displaying About Us Hero section
 * 
 * WCAG 2.1 AA compliant hero banner with BEM methodology
 * Compatible with WordPress 6.x and WooCommerce 8.x+
 *
 * @package Pen-pol
 * @since 1.0.0
 */

// Security check
if (!defined('ABSPATH')) {
    exit;
}

// Get hero data from ACF
$hero_group = get_field('o_nas-hero');

// Early return if no data
if (empty($hero_group)) {
    return;
}

// Extract data from ACF fields
$image_id = $hero_group['o_nas-hero-obrazek'] ?? 0;
$heading = $hero_group['o_nas-hero-naglowek'] ?? '';
$description = $hero_group['o_nas-hero-opis'] ?? '';
$button_url = $hero_group['o_nas-hero-button_url'] ?? '';

// Skip if no essential content
if (empty($image_id) && empty($heading)) {
    return;
}

// Prepare image data
$image_url = wp_get_attachment_image_url($image_id, 'full');
$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

// Fallback alt text if empty
if (empty($image_alt)) {
    $image_alt = __('Tło sekcji O nas', 'pen-pol');
}

// Generate unique section ID for accessibility
$section_id = 'about-hero-' . wp_unique_id();
?>

<section class="about-hero-wrapper" 
         id="<?php echo esc_attr($section_id); ?>" 
         aria-label="<?php esc_attr_e('Baner strony O nas', 'pen-pol'); ?>">
    
    <div class="about-hero-container">
        <div class="about-hero">
            <!-- Background with image and overlay -->
            <div class="about-hero__background">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" 
                         alt="<?php echo esc_attr($image_alt); ?>" 
                         class="about-hero__image"
                         loading="eager"
                         width="1920" 
                         height="1080"
                         fetchpriority="high">
                <?php endif; ?>
                
                <div class="about-hero__overlay" aria-hidden="true"></div>
            </div>
            
            <!-- Content area -->
            <div class="about-hero__content">
                <div class="container">
                    <div class="about-hero__wrapper">
                        <!-- Header section with title -->
                        <header class="about-hero__header">
                            <div class="about-hero__text-content">
                            <?php if ($heading): ?>
                                <h1 class="about-hero__title">
                                    <?php echo wp_kses($heading, [
                                        'span' => ['class' => []],
                                        'br' => []
                                    ]); ?>
                                </h1>
                            <?php endif; ?>
                            </div>
                        </header>
                        
                        <!-- Body section with description and CTA -->
                        <div class="about-hero__body">
                            <div class="about-hero__text-content">
                                <?php if ($description): ?>
                                    <div class="about-hero__description">
                                        <?php echo wp_kses_post($description); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                        <?php if ($button_url): ?>
                            <div class="about-hero__controls">
                                <a href="<?php echo esc_url($button_url); ?>" 
                                class="btn btn--link btn--link--light">
                                    <span class="btn__text">
                                        <?php esc_html_e('Kontakt', 'pen-pol'); ?>
                                    </span>
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-top_right.svg'); ?>" 
                                        class="btn__icon btn__icon--right" 
                                        alt="" 
                                        aria-hidden="true">
                                </a>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>