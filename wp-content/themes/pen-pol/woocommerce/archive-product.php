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
    
    // Wymuszone ustawienie 8 produktów na stronę
    wc_set_loop_prop('per_page', 8);
    // Dodanie klasy do kontenera produktów - dokładnie 4 kolumny
    wc_set_loop_prop('columns', 4);

    if (woocommerce_product_loop()) {
        // Filters section with custom container
        ?>
        <div class="shop-archive__filters">
            <div class="container">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');
                ?>
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
</section>

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

<?php
get_footer('shop');
?>