<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template handles three different contexts:
 * 1. Main shop page (/sklep)
 * 2. Product category (/sklep/[kategoria])
 * 3. Product subcategory (/sklep/[kategoria]/[podkategoria])
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Pen-pol
 * @version 1.0.0 (Based on WooCommerce 8.6.0)
 */

defined('ABSPATH') || exit;


// Usunięcie domyślnego nagłówka WooCommerce i sidebara
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

get_header('shop');

/**
 * Determine current archive context (shop, category, subcategory)
 * and fetch necessary term data
 */
$context = 'shop';
$current_category = null;
$parent_category = null;

if (is_product_category()) {
    $context = 'category';
    $current_category = get_queried_object();
    
    // Check if this is a subcategory
    if ($current_category && $current_category->parent !== 0) {
        $context = 'subcategory';
        $parent_category = get_term($current_category->parent, 'product_cat');
    }
}

/**
 * Get banner image from ACF or use default
 */
$banner_img_id = 0;
$banner_img_url = '/wp-content/uploads/2025/07/12161.jpg'; // Default banner

if ($current_category) {
    $banner_img_id = get_field('woo-banner', 'product_cat_' . $current_category->term_id);
    if ($banner_img_id) {
        $banner_img_url = wp_get_attachment_image_url($banner_img_id, 'full');
    }
}

/**
 * Get ACF data for info tiles with proper fallbacks
 */
$info_tiles = [];

if ($current_category) {
    $info_tiles = [
        [
            'title' => __('Właściwości', 'pen-pol'),
            'content' => get_field('woo-wlasciwosci', 'product_cat_' . $current_category->term_id)
        ],
        [
            'title' => __('Temperatura snu', 'pen-pol'),
            'content' => get_field('woo-temperatura', 'product_cat_' . $current_category->term_id)
        ],
        [
            'title' => __('Idealne dla...', 'pen-pol'),
            'content' => get_field('woo-idealne_dla', 'product_cat_' . $current_category->term_id)
        ],
        [
            'title' => __('Pozycja spania', 'pen-pol'),
            'content' => get_field('woo-pozycja_spania', 'product_cat_' . $current_category->term_id)
        ]
    ];
    
    // Filter out empty tiles
    $info_tiles = array_filter($info_tiles, function($tile) {
        return !empty($tile['content']);
    });
}

// Rozpocznij sekcję archiwum
?>

<section class="shop-archive">
    <!-- Custom Breadcrumbs section -->
    <div class="container">
        <nav class="shop-archive__breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'pen-pol'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php esc_html_e('Strona Główna', 'pen-pol'); ?>
            </a>
            <span class="separator" aria-hidden="true">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg'); ?>" alt="">
            </span>
            
            <?php if ($context === 'shop') : ?>
                <span aria-current="page"><?php esc_html_e('Sklep', 'pen-pol'); ?></span>
            <?php elseif ($context === 'category') : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                    <?php esc_html_e('Sklep', 'pen-pol'); ?>
                </a>
                <span class="separator" aria-hidden="true">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg'); ?>" alt="">
                </span>
                <span aria-current="page"><?php echo esc_html($current_category->name); ?></span>
            <?php elseif ($context === 'subcategory') : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                    <?php esc_html_e('Sklep', 'pen-pol'); ?>
                </a>
                <span class="separator" aria-hidden="true">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg'); ?>" alt="">
                </span>
                <a href="<?php echo esc_url(get_term_link($parent_category)); ?>">
                    <?php echo esc_html($parent_category->name); ?>
                </a>
                <span class="separator" aria-hidden="true">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg'); ?>" alt="">
                </span>
                <span aria-current="page"><?php echo esc_html($current_category->name); ?></span>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Custom Banner section -->
    <div class="shop-archive__banner" aria-labelledby="shop-title">
        <div class="container">
            <div class="shop-archive__banner-inner<?php echo (!empty($info_tiles)) ? ' shop-archive__banner-inner--with-tiles' : ''; ?>" style="background-image: url('<?php echo esc_url($banner_img_url); ?>');">
                <div class="shop-archive__header">
                    <!-- Left container with category title - varies by context -->
                    <div class="shop-archive__title-container">
                        <?php if ($context === 'shop') : ?>
                            <h1 id="shop-title" class="shop-archive__title"><?php esc_html_e('Sklep', 'pen-pol'); ?></h1>
                        <?php elseif ($context === 'category') : ?>
                            <h1 id="shop-title" class="shop-archive__title"><?php echo esc_html($current_category->name); ?></h1>
                        <?php elseif ($context === 'subcategory') : ?>
                            <div class="shop-archive__parent-category">
                                <a href="<?php echo esc_url(get_term_link($parent_category)); ?>">
                                    <?php echo esc_html($parent_category->name); ?>
                                </a>
                            </div>
                            <h1 id="shop-title" class="shop-archive__title"><?php echo esc_html($current_category->name); ?></h1>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Right container with info tiles -->
                    <?php if (!empty($info_tiles)) : ?>
                    <div class="shop-archive__info-tiles">
                        <?php foreach ($info_tiles as $tile) : ?>
                        <div class="shop-archive__info-tile">
                            <h3 class="shop-archive__info-tile-title"><?php echo esc_html($tile['title']); ?></h3>
                            <div class="shop-archive__info-tile-content">
                                <?php echo wp_kses_post($tile['content']); ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    /**
     * Hook: woocommerce_before_main_content.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20 (we've already added our own breadcrumbs)
     * @hooked WC_Structured_Data::generate_website_data() - 30
     */
    // Remove standard WooCommerce breadcrumbs since we have our own
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    do_action('woocommerce_before_main_content');
    
    if (woocommerce_product_loop()) {
        // Definiuj dostępne filtry dla sklepu
        $available_filters = array(
            'typ_produktu' => 'Typ produktu',
            'rozmiar' => 'Rozmiar',
            'wypelnienie' => 'Wypełnienie',
            'pozycja_spania' => 'Pozycja spania'
        );
        ?>
        
        <!-- Filtry section with custom container -->
        <div class="shop-archive__filters">
            <div class="container">
                <div class="shop-archive__filters-section">
                    <!-- Mobile filter button -->
                    <div class="shop-archive__mobile-trigger">
                        <button type="button" id="mobile-filter-open">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 4H13.5M4 8H12M6 12H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php esc_html_e('Filtry', 'pen-pol'); ?>
                            <span class="shop-archive__mobile-count"></span>
                        </button>
                    </div>
                    
                    <!-- Desktop filters -->
                    <div class="shop-archive__filters-desktop">
                        <?php foreach ($available_filters as $filter_name => $filter_title): ?>
                            <div class="shop-archive__filter-item" data-filter="<?php echo esc_attr($filter_name); ?>">
                                <button type="button" class="shop-archive__filter-toggle">
                                    <?php echo esc_html($filter_title); ?>
                                    <span class="shop-archive__filter-count"></span>
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <div class="shop-archive__filter-content">
                                    <?php echo do_shortcode('[facetwp facet="' . esc_attr($filter_name) . '"]'); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Filter status and sorting container -->
                    <div class="shop-archive__filter-status-container">
                        <!-- Left side - filter status -->
                        <div class="shop-archive__filter-status">
                            <div class="shop-archive__label"><?php esc_html_e('FILTRY', 'pen-pol'); ?></div>
                            <div class="shop-archive__selected-filters">
                                <?php echo do_shortcode('[facetwp selections="true"]'); ?>
                            </div>
                            <div class="shop-archive__reset">
                                <?php echo do_shortcode('[facetwp facet="reset"]'); ?>
                            </div>
                        </div>
                        
                        <!-- Right side - WooCommerce sorting -->
                        <div class="shop-archive__sorting">
                            <?php
                            // Temporarily remove result count to only show ordering
                            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                            // Only display the sorting dropdown
                            woocommerce_catalog_ordering();
                            // Restore result count for future use
                            add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden standard WooCommerce notices -->
                <div class="shop-archive__woocommerce-notices" style="display: none;">
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     * 
                     * We're hiding this but keeping it to make sure all hooks run correctly
                     * 
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20 (temporarily removed above)
                     * @hooked woocommerce_catalog_ordering - 30 (displayed separately above)
                     */
                    do_action('woocommerce_before_shop_loop');
                    ?>
                </div>
            </div>
        </div>

        <!-- Mobile filters modal -->
        <div class="shop-archive__mobile-modal" id="mobile-filters-modal">
            <div class="shop-archive__mobile-overlay" id="mobile-filter-close-overlay"></div>
            <div class="shop-archive__mobile-container">
                <div class="shop-archive__mobile-header">
                    <h3><?php esc_html_e('Filtry', 'pen-pol'); ?></h3>
                    <button type="button" id="mobile-filter-close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <div class="shop-archive__mobile-body">
                    <?php foreach ($available_filters as $filter_name => $filter_title): ?>
                        <div class="shop-archive__mobile-filter" data-filter="<?php echo esc_attr($filter_name); ?>">
                            <h4><?php echo esc_html($filter_title); ?></h4>
                            <?php echo do_shortcode('[facetwp facet="' . esc_attr($filter_name) . '"]'); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="shop-archive__mobile-footer">
                    <button type="button" id="mobile-filter-reset">
                        <?php esc_html_e('Resetuj filtry', 'pen-pol'); ?>
                    </button>
                    <button type="button" id="mobile-filter-apply">
                        <?php esc_html_e('Zastosuj', 'pen-pol'); ?>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Products section - używamy standardowego wyświetlania WooCommerce -->
        <div class="shop-archive__products">
            <div class="container">
                <?php
                /**
                 * Standardowe wyświetlanie produktów WooCommerce z gridem 4x2
                 */
                echo '<div class="product-grid-wrapper">'; // Dodatkowy wrapper dla lepszej kontroli
                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();
                        
                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action('woocommerce_shop_loop');
                        
                        /**
                         * Użyj standardowego szablonu produktu WooCommerce
                         */
                        wc_get_template_part('content', 'product');
                    }
                }

                woocommerce_product_loop_end();
                echo '</div>'; // Zamknięcie dodatkowego wrappera

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
                ?>
            </div>
        </div>
        <?php
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        ?>
        <div class="container">
            <?php do_action('woocommerce_no_products_found'); ?>
        </div>
        <?php
    }

    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');

    // Category description (if exists)
    if (is_product_category() && $current_category) {
        $category_description = term_description($current_category->term_id, 'product_cat');
        
        if (!empty($category_description)) : ?>
            <section class="shop-archive__description">
                <div class="container">
                    <div class="shop-archive__description-content">
                        <?php echo wp_kses_post($category_description); ?>
                    </div>
                </div>
            </section>
        <?php endif;
    }
    ?>

    <!-- Test poduszki - dodaj przed zamknięciem </section> na końcu pliku archive-product.php -->
    <section class="shop-archive__test-poduszki">
        <div class="container">
            <div class="test-poduszki">
                <div class="test-poduszki__content">
                    <h2 class="test-poduszki__heading">
                        <span class="test-poduszki__heading-part test-poduszki__heading-part--serif">Nie wiesz, </span>
                        <span class="test-poduszki__heading-part">jaką poduszkę wybrać?</span>
                    </h2>
                    <p class="test-poduszki__text">
                        <strong>Zrób krótki test i znajdź idealną poduszkę dopasowaną do Twoich potrzeb!</strong>
                        Odpowiedz na kilka pytań, a my dobierzemy najlepsze wypełnienie, twardość i rozmiar – tak, byś spał(a) wygodnie każdej nocy.
                    </p>
                    <a href="<?php echo esc_url(home_url('/test-poduszki/')); ?>" class="test-poduszki__button">
                        Zaczynam Test! 
                        <span class="test-poduszki__button-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black2.svg'); ?>" alt="" aria-hidden="true" width="14" height="14">
                        </span>
                    </a>
                </div>
                <div class="test-poduszki__image-wrapper">
                    <img 
                        src="<?php echo esc_url('/wp-content/uploads/2025/07/archiwum-zdjecie.png'); ?>" 
                        alt="<?php esc_attr_e('Kobieta obejmująca poduszkę', 'pen-pol'); ?>"
                        class="test-poduszki__image"
                        width="500"
                        height="300"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>
</section>

<?php
get_footer('shop');
?>