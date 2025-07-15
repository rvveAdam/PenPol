<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$post_thumbnail_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();

// Łączymy główne zdjęcie i galerię do jednej tablicy
$all_image_ids = array();
if ($post_thumbnail_id) {
    $all_image_ids[] = $post_thumbnail_id;
}
if ($gallery_image_ids) {
    $all_image_ids = array_merge($all_image_ids, $gallery_image_ids);
}
?>

<div class="product-gallery">
    <?php if (!empty($all_image_ids)) : ?>
    
    <!-- Miniatury (lewa kolumna) -->
    <div class="product-gallery-thumbs">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                foreach ($all_image_ids as $attachment_id) :
                    $image_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                    if (empty($image_alt)) {
                        $image_alt = get_the_title($attachment_id);
                    }
                ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image_src[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" loading="lazy" decoding="async">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Nawigacja dla karuzel pionowych (na desktop) -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    
    <!-- Główne zdjęcie (prawa kolumna) -->
    <div class="product-gallery-main">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                foreach ($all_image_ids as $attachment_id) :
                    $image = wp_get_attachment_image(
                        $attachment_id,
                        'woocommerce_single',
                        false,
                        array(
                            'class' => 'wp-post-image',
                            'loading' => $attachment_id === $post_thumbnail_id ? 'eager' : 'lazy',
                            'decoding' => 'async',
                            'fetchpriority' => $attachment_id === $post_thumbnail_id ? 'high' : 'auto',
                        )
                    );
                ?>
                <div class="swiper-slide">
                    <?php echo $image; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Nawigacja dla głównego widoku -->
            <div class="swiper-pagination product-gallery-main-pagination"></div>
            <div class="swiper-button-next product-gallery-main-next"></div>
            <div class="swiper-button-prev product-gallery-main-prev"></div>
        </div>
    </div>
    
    <?php else : ?>
    <div class="product-gallery-main">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php echo wc_placeholder_img('woocommerce_single', array('class' => 'wp-post-image')); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>