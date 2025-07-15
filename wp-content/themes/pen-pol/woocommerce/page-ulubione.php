<?php
/**
 * Template Name: Ulubione
 * Template Post Type: page
 * 
 * Szablon strony wyświetlającej ulubione produkty użytkownika.
 * Wykorzystuje ciasteczka do przechowywania ID ulubionych produktów.
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="favorites">
    <section class="favorites__section" aria-labelledby="favorites-heading">
        <div class="container">
            <div class="favorites__header">
                <h1 id="favorites-heading" class="favorites__title"><?php esc_html_e('Ulubione', 'pen-pol'); ?></h1>
            </div>

            <?php
            // Pobierz ulubione produkty z cookies
            $favorites = array();
            if (isset($_COOKIE['wc_favorites'])) {
                $favorites = json_decode(stripslashes($_COOKIE['wc_favorites']), true);
            }
            
            if (!empty($favorites) && is_array($favorites)) :
                // Filtruj tylko istniejące produkty
                $existing_favorites = array();
                foreach ($favorites as $product_id) {
                    $product = wc_get_product($product_id);
                    if ($product && $product->exists()) {
                        $existing_favorites[] = $product_id;
                    }
                }
                
                if (!empty($existing_favorites)) :
                    // Zapytanie WooCommerce o produkty
                    $args = array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'post__in' => $existing_favorites,
                        'posts_per_page' => -1,
                        'orderby' => 'post__in'
                    );
                    
                    $favorites_query = new WP_Query($args);
                    
                    if ($favorites_query->have_posts()) : ?>
                        <div class="favorites__controls">
                            <div class="favorites__count">
                                <span class="favorites__count-number"><?php echo count($existing_favorites); ?></span>
                                <span class="favorites__count-text">
                                <?php 
                                $count = count($existing_favorites);
                                if ($count == 1) {
                                    esc_html_e('produkt', 'pen-pol');
                                } elseif ($count < 5) {
                                    esc_html_e('produkty', 'pen-pol');
                                } else {
                                    esc_html_e('produktów', 'pen-pol');
                                }
                                ?>
                                </span>
                            </div>

                            <button type="button" 
                                class="favorites__clear-button" 
                                onclick="clearAllFavorites()"
                                aria-label="<?php esc_attr_e('Usuń wszystkie ulubione produkty', 'pen-pol'); ?>">
                                <?php esc_html_e('Usuń ulubione', 'pen-pol'); ?>
                            </button>
                        </div>

                        <div class="favorites__grid">
                            <?php while ($favorites_query->have_posts()) : $favorites_query->the_post();
                                global $product;
                                $product = wc_get_product(get_the_ID());
                                
                                if (!$product) continue;
                                
                                // Użyj istniejącego template part produktu z folderu woocommerce
                                wc_get_template_part('content-product');
                                
                            endwhile; ?>
                        </div>

                    <?php else : ?>
                        <div class="favorites__empty">
                            <div class="favorites__empty-icon">
                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fav.svg" alt="" aria-hidden="true">
                            </div>
                            <h2 class="favorites__empty-title"><?php esc_html_e('Brak ulubionych produktów', 'pen-pol'); ?></h2>
                            <p class="favorites__empty-text"><?php esc_html_e('Nie masz jeszcze żadnych ulubionych produktów. Przeglądaj naszą ofertę i dodawaj produkty do ulubionych!', 'pen-pol'); ?></p>
                            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="favorites__shop-button">
                                <?php esc_html_e('Przeglądaj produkty', 'pen-pol'); ?>
                            </a>
                        </div>
                    <?php endif;
                    
                    wp_reset_postdata();
                    
                else : ?>
                    <div class="favorites__empty">
                        <div class="favorites__empty-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fav.svg" alt="" aria-hidden="true">
                        </div>
                        <h2 class="favorites__empty-title"><?php esc_html_e('Brak ulubionych produktów', 'pen-pol'); ?></h2>
                        <p class="favorites__empty-text"><?php esc_html_e('Nie masz jeszcze żadnych ulubionych produktów. Przeglądaj naszą ofertę i dodawaj produkty do ulubionych!', 'pen-pol'); ?></p>
                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="favorites__shop-button">
                            <?php esc_html_e('Przeglądaj produkty', 'pen-pol'); ?>
                        </a>
                    </div>
                <?php endif;
                
            else : ?>
                <div class="favorites__empty">
                    <div class="favorites__empty-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fav.svg" alt="" aria-hidden="true">
                    </div>
                    <h2 class="favorites__empty-title"><?php esc_html_e('Brak ulubionych produktów', 'pen-pol'); ?></h2>
                    <p class="favorites__empty-text"><?php esc_html_e('Nie masz jeszcze żadnych ulubionych produktów. Przeglądaj naszą ofertę i dodawaj produkty do ulubionych!', 'pen-pol'); ?></p>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="favorites__shop-button">
                        <?php esc_html_e('Przeglądaj produkty', 'pen-pol'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();