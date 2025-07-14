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

// Ograniczenie liczby produktów do 8 na stronę (filtr)
add_filter('loop_shop_per_page', function() { return 8; }, 1); // Zmiana priorytetu na 1 (najwyższy)

// Dodatkowe wymuszenie limitu przez pre_get_posts (najsilniejsze)
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        $query->set('posts_per_page', 8);
    }
}, 1);

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
    
    wc_set_loop_prop('per_page', 8);

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

        <!-- Products section with custom grid -->
        <div class="shop-archive__products">
            <div class="container">
                <div class="product-grid">
                    <?php
                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();
                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            // Use our custom product card instead of the default WooCommerce template
                            get_template_part('woocommerce/product-card');
                        }
                    }
                    ?>
                </div>

                <?php
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                // Remove default WooCommerce pagination as we'll add our custom one
                remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
                do_action('woocommerce_after_shop_loop');

                // Add custom pagination
                $total_pages = wc_get_loop_prop('total_pages');
                $current_page = max(1, wc_get_loop_prop('current_page'));

                if ($total_pages > 1) : ?>
                    <nav class="shop-archive__pagination" aria-label="<?php esc_attr_e('Pagination', 'pen-pol'); ?>">
                        <!-- Previous page arrow -->
                        <div class="shop-archive__pagination-arrow shop-archive__pagination-arrow--prev">
                            <?php if ($current_page > 1) : 
                                // Poprawna struktura linku dla WooCommerce
                                $prev_page_url = add_query_arg('paged', max(1, $current_page - 1), remove_query_arg('add-to-cart'));
                            ?>
                                <a href="<?php echo esc_url($prev_page_url); ?>" aria-label="<?php esc_attr_e('Previous page', 'pen-pol'); ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left.svg'); ?>" alt="">
                                </a>
                            <?php else : ?>
                                <a href="#" class="disabled" aria-disabled="true" tabindex="-1">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-left.svg'); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Numeric pagination -->
                        <div class="shop-archive__pagination-numbers">
                            <?php
                            // Poprawne linkowanie paginacji dla WooCommerce
                            echo paginate_links(array(
                                'prev_next' => false,
                                'end_size' => 3,
                                'mid_size' => 0,
                                'type' => 'plain',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'base' => add_query_arg('paged', '%#%', remove_query_arg('add-to-cart')),
                                'format' => '',
                            ));
                            ?>
                        </div>
                        
                        <!-- Next page arrow -->
                        <div class="shop-archive__pagination-arrow shop-archive__pagination-arrow--next">
                            <?php if ($current_page < $total_pages) : 
                                // Poprawna struktura linku dla WooCommerce
                                $next_page_url = add_query_arg('paged', min($total_pages, $current_page + 1), remove_query_arg('add-to-cart'));
                            ?>
                                <a href="<?php echo esc_url($next_page_url); ?>" aria-label="<?php esc_attr_e('Next page', 'pen-pol'); ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.svg'); ?>" alt="">
                                </a>
                            <?php else : ?>
                                <a href="#" class="disabled" aria-disabled="true" tabindex="-1">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.svg'); ?>" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>
                <?php endif; ?>
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

<?php
get_footer('shop');