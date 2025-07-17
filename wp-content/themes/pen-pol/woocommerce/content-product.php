<?php
/**
 * Template part for displaying product card
 *
 * @package Pen-pol
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

global $product;

// Ensure $product is valid
if (!$product || !is_a($product, 'WC_Product')) {
    return;
}

// Get product data
$product_id = $product->get_id();
$product_name = $product->get_name();
$image_id = $product->get_image_id();

// Get product category (only the deepest subcategory)
$categories = get_the_terms($product_id, 'product_cat');
$category_name = '';

if (!empty($categories) && !is_wp_error($categories)) {
    // Find the deepest category (the one with no children)
    $deepest_category = null;
    $max_depth = -1;
    
    foreach ($categories as $category) {
        $depth = 0;
        $parent_id = $category->parent;
        
        while ($parent_id > 0) {
            $depth++;
            $parent = get_term($parent_id, 'product_cat');
            if (is_wp_error($parent)) {
                break;
            }
            $parent_id = $parent->parent;
        }
        
        if ($depth > $max_depth) {
            $max_depth = $depth;
            $deepest_category = $category;
        }
    }
    
    // If no child category was found, use the first category
    if ($deepest_category === null && !empty($categories)) {
        $deepest_category = $categories[0];
    }
    
    if ($deepest_category) {
        $category_name = $deepest_category->name;
    }
}

// Get product attributes from custom taxonomy
$attributes = get_the_terms($product_id, 'szczegoly-produktu');

// Ceny - pobranie zwykłej i promocyjnej
$regular_price = $product->get_regular_price();
$sale_price = $product->is_on_sale() ? $product->get_sale_price() : '';
?>

<div class="product-card">
    <div class="product-card__wrapper">
        <?php echo do_shortcode('[product_badge_card]'); ?>
        
        <div class="fav-icon">
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fav.svg" alt="<?php esc_attr_e('Add to favorites', 'pen-pol'); ?>">
            </a>
        </div>
        
        <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="product-card__image-link">
            <?php if ($image_id) : ?>
                <?php echo wp_get_attachment_image($image_id, 'woocommerce_thumbnail', false, array('class' => 'product-card__image')); ?>
            <?php else : ?>
                <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="<?php esc_attr_e('Product placeholder', 'pen-pol'); ?>" class="product-card__image">
            <?php endif; ?>
        </a>
        
        <div class="product-card__content">
            <?php if (!empty($category_name)) : ?>
                <div class="product-card__category">
                    <?php echo esc_html($category_name); ?>
                </div>
            <?php endif; ?>
            
            <h3 class="product-card__title">
                <a href="<?php echo esc_url(get_permalink($product_id)); ?>">
                    <?php echo esc_html($product_name); ?>
                </a>
            </h3>
            
            <div class="product-card__price-wrapper">
                <div class="product-card__price">
                    <?php if (!empty($sale_price)) : ?>
                        <!-- Cena promocyjna (wyświetlana na górze) -->
                        <ins>
                            <span class="woocommerce-Price-amount amount">
                                <?php echo wc_price($sale_price); ?>
                            </span>
                        </ins>
                        
                        <!-- Stara cena (przekreślona, na dole) -->
                        <del>
                            <span class="woocommerce-Price-amount amount">
                                <?php echo wc_price($regular_price); ?>
                            </span>
                        </del>
                        
                        <!-- Tekst dla czytników ekranowych -->
                        <span class="screen-reader-text">
                            <?php printf(__('Original price was: %s.', 'pen-pol'), wc_price($regular_price)); ?>
                            <?php printf(__('Current price is: %s.', 'pen-pol'), wc_price($sale_price)); ?>
                        </span>
                    <?php else : ?>
                        <!-- Zwykła cena (bez promocji) -->
                        <span class="woocommerce-Price-amount amount">
                            <?php echo wc_price($regular_price); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="product-card__cart">
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" data-quantity="1" class="product-card__cart-button" data-product_id="<?php echo esc_attr($product_id); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/koszyk.svg" alt="<?php esc_attr_e('Add to cart', 'pen-pol'); ?>">
                    </a>
                </div>
            </div>
            
            <?php if (!empty($attributes) && !is_wp_error($attributes)) : ?>
                <div class="product-card__meta">
                    <div class="product-card__categories">
                        <?php foreach ($attributes as $attribute) : 
                            $attribute_id = $attribute->term_id;
                            $icon_id = get_field('tax-ikonka_atrybutu', 'szczegoly-produktu_' . $attribute_id);
                        ?>
                            <div class="product-card__attribute">
                                <?php if ($icon_id) : ?>
                                    <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, array('class' => 'product-card__attribute-icon')); ?>
                                <?php endif; ?>
                                <?php echo esc_html($attribute->name); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $product_id = $product->get_id();
            $compare_products = function_exists('get_compare_products') ? get_compare_products() : [];
            $is_in_compare = in_array($product_id, $compare_products);

            $action = $is_in_compare ? 'remove-from-compare' : 'add-to-compare';
            $text = $is_in_compare ? ('Usuń z porównania') : ('Dodaj do porównania');
            $icon = $is_in_compare ? 'minus' : 'plus';
            ?>

            <button class="compare-button <?php echo esc_attr($action); ?>"
                data-product-id="<?php echo esc_attr($product_id); ?>" title="<?php echo esc_attr($text); ?>">
                <span><?php _e('Porównaj'); ?></span>
            </button>

            <style>
            /* 
            * Product Card - Compare Button Styles
            * Przenieś ten kod do głównego pliku SCSS
            */
            @keyframes compareButtonFadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
            @keyframes compareButtonFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
            }

            .product-card {
                position: relative;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .product-card__wrapper {
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .product-card__content {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
                justify-content: space-between;
                padding: 16px;
            }

            .product-card__details {
                flex-grow: 1;
           }

            .product-card__footer {
                margin-top: 12px;
                display: flex;
                flex-direction: column;
            }

            .product-card__price-wrapper {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }
        
            /* Stylowanie przycisku porównania */
            .product-card .compare-button {
                visibility: hidden;
                opacity: 0;
                align-self: flex-end;
                display: flex;
                align-items: center;
                background: transparent;
                border: none;
                padding: 0;
                margin-top: 4px;
                font-size: 14px;
                color: #666666;
                cursor: pointer;
                transition: color 0.2s ease;
            }

            .product-card:hover .compare-button {
                visibility: visible;
                opacity: 1;
                animation: compareButtonFadeIn 0.3s ease forwards;
            }

            .product-card .compare-button span {
                margin-right: 8px;
            }

            .product-card .compare-button::after {
                content: '';
                display: inline-block;
                width: 16px;
                height: 16px;
                border: 1px solid #666666;
                border-radius: 2px;
                position: relative;
                top: 2px;
                transition: border-color 0.2s ease, background-color 0.2s ease;
            }

            .product-card .compare-button.remove-from-compare::after {
                background-color: #132684;
                border-color: #132684;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='8' viewBox='0 0 10 8' fill='none'%3E%3Cpath d='M1 4L3.5 6.5L9 1' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: center;
            }

            .product-card .compare-button:hover {
                color: #132684;
            }

            .product-card .compare-button:hover::after {
                border-color: #132684;
            }

            /* Dostępność */
            @media (prefers-reduced-motion: reduce) {
                .product-card .compare-button {
                    transition: none;
            }
                
            .product-card:hover .compare-button {
                    animation: none;
                }
            }

            .product-card .compare-button:focus-visible {
                outline: 2px solid #2563eb;
                outline-offset: 2px;
                visibility: visible;
                opacity: 1;
            }

            /* Ukrycie w porównywarce */
            .porownywarka-table-layout .product-card .compare-button {
                display: none;
            }
            </style>

        </div>
    </div>
</div>