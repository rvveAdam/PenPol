<?php
/**
 * The template for displaying single product page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php
 *
 * @package Pen-pol
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<main id="primary" class="site-main single-product">
    <?php while (have_posts()) : the_post(); ?>
    
    <?php
    /**
     * Hook: woocommerce_before_main_content.
     * 
     * Breadcrumbs removed via functions.php (remove_action)
     */
    do_action('woocommerce_before_main_content');
    ?>

    <!-- Hero section -->
    <section class="single-product-hero-section">
        <div class="product-container">
            <!-- Breadcrumbs - moved here from the hook -->
            <div class="product-breadcrumbs">
                <?php woocommerce_breadcrumb(); ?>
            </div>
            
            <div class="product-container--content">
                <!-- Galeria produktu -->
                <div class="product-images">
                    <?php 
                    
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action('woocommerce_before_single_product_summary'); 
                    ?>
                </div>

                <div class="product-summary">
                    <?php
                    global $product;
                    
                    // Pobieranie kategorii produktu
                    $terms = get_the_terms($product->get_id(), 'product_cat');
                    $main_cat = null;
                    if ($terms && !is_wp_error($terms)) {
                        // Sortowanie kategorii wg hierarchii (najpierw podkategorie)
                        usort($terms, function($a, $b) {
                            return $b->parent - $a->parent; // Zmiana kolejności, aby podkategorie były pierwsze
                        });
                        $main_cat = $terms[0]; // Pobierz pierwszą (najniższą) kategorię
                    }
                    
                    // Pobieranie tagów produktu
                    $product_tags = wp_get_post_terms($product->get_id(), 'product_tag');
                    
                    // Sprawdzanie czy produkt jest w promocji
                    $is_on_sale = $product->is_on_sale();
                    ?>

                    <!-- Przycisk ulubionych w prawym górnym rogu -->
                    <div class="fav-icon product-card">
                        <a href="#" class="add-to-favorites" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fav.svg" alt="<?php esc_attr_e('Add to favorites', 'pen-pol'); ?>">
                        </a>
                    </div>
                    <!-- Kategoria produktu -->
                    <?php if (!empty($main_cat)) : ?>
                    <div class="product-main-category">
                        <span><?php echo esc_html($main_cat->name); ?></span>
                    </div>
                    <?php endif; ?>

                    <!-- Tytuł produktu -->
                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <!-- SKU produktu -->
                    <?php if ($product->get_sku()) : ?>
                    <div class="product-sku">
                        <strong><?php esc_html_e('KOD:', 'pen-pol'); ?></strong> <?php echo esc_html($product->get_sku()); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Krótki opis produktu -->
                    <?php if (has_excerpt()) : ?>
                    <div class="product-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Szczegóły produktu - CPT -->
                    <?php
                    // Pobierz szczegóły produktu - CPT
                    $attributes = get_the_terms($product->get_id(), 'szczegoly-produktu');
                    if (!empty($attributes) && !is_wp_error($attributes)) : 
                    ?>
                    <div class="product-details">
                        <?php foreach ($attributes as $attribute) : 
                            $attribute_id = $attribute->term_id;
                            $icon_id = get_field('tax-ikonka_atrybutu', 'szczegoly-produktu_' . $attribute_id);
                        ?>
                        <div class="product-details__attribute">
                            <?php if ($icon_id) : ?>
                                <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, array('class' => 'product-details__attribute-icon')); ?>
                            <?php endif; ?>
                            <span><?php echo esc_html($attribute->name); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Warianty produktu - dropdown -->
                    <!-- Tutaj implementujemy dropdown do przełączania między "wariantami" produktów -->
                    <?php
                    // Pobieramy produkty z tej samej kategorii, które mogą być wariantami
                    $related_products = array();
                    if (!empty($main_cat)) {
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'post__not_in' => array($product->get_id()), // wykluczamy aktualny produkt
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $main_cat->term_id,
                                ),
                            ),
                        );
                        
                        $related_query = new WP_Query($args);
                        if ($related_query->have_posts()) {
                            while ($related_query->have_posts()) {
                                $related_query->the_post();
                                $related_products[] = array(
                                    'id' => get_the_ID(),
                                    'title' => get_the_title(),
                                    'permalink' => get_permalink(),
                                );
                            }
                            wp_reset_postdata();
                        }
                    }
                    
                    // Jeśli znaleziono powiązane produkty, wyświetl dropdown
                    if (!empty($related_products)) :
                    ?>
                    <div class="product-variants">
                        <div class="variant-selector">
                            <div class="variant-selector__header">
                                <span class="variant-selector__header-text">
                                    <?php esc_html_e('Wybierz rozmiar:', 'pen-pol'); ?> <strong><?php echo esc_html($product->get_title()); ?></strong>
                                </span>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-down.svg'); ?>" alt="Rozwiń" class="variant-selector__header-icon">
                            </div>
                            <div class="variant-selector__dropdown">
                                <?php foreach ($related_products as $related) : ?>
                                <div class="variant-selector__dropdown-item" data-product-id="<?php echo esc_attr($related['id']); ?>">
                                    <input type="radio" name="product_variant" id="variant-<?php echo esc_attr($related['id']); ?>" value="<?php echo esc_attr($related['id']); ?>">
                                    <label for="variant-<?php echo esc_attr($related['id']); ?>" class="variant-selector__dropdown-item-label">
                                        <?php echo esc_html($related['title']); ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Ceny produktu - poprawione dla cen promocyjnych -->
                    <div class="product-prices">
                        <div class="price-single-product-section">
                            <!-- Cena produktu -->
                            <div class="price-single-product-brutto">
                                <?php if ($product->is_on_sale()) : ?>
                                    <h2 class="price-value price-value--sale">
                                        <span class="price-old"><?php echo wc_price($product->get_regular_price()); ?></span>
                                        <span class="price-current"><?php echo wc_price($product->get_sale_price()); ?></span>
                                    </h2>
                                <?php else : ?>
                                    <h2 class="price-value">
                                        <?php echo wc_price($product->get_price()); ?>
                                    </h2>
                                <?php endif; ?>
                            </div>
                            <div class="product-badges">
                                <?php 
                                // Bezpośrednie wywołanie zamiast shortcode'a
                                $badge = pen_pol_get_product_badge($product);
                                if ($badge) : ?>
                                    <span class="badge badge-sale badge-<?php echo esc_attr($badge['type']); ?>">
                                        <?php echo esc_html($badge['text']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Przyciski do koszyka -->
                    <div class="cart-actions">
                        <div class="cart-actions__row">
                            <!-- Przycisk dodaj do koszyka - dodana ikona strzałki -->
                               <?php woocommerce_template_single_add_to_cart(); ?>
                        </div>
                    </div>

                    <!-- Dodatkowe info - ikony -->
                    <div class="add-info-product-section">
                        <div class="info-card">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/poland.svg'); ?>" alt="<?php esc_attr_e('Produkt EU', 'pen-pol'); ?>" class="info-card-icon">
                            <p><?php esc_html_e('Produkt EU', 'pen-pol'); ?></p>
                        </div>
                        <div class="info-card">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/quality-badge.svg'); ?>" alt="<?php esc_attr_e('5 lat gwarancji', 'pen-pol'); ?>" class="info-card-icon">
                            <p><?php esc_html_e('5 lat gwarancji', 'pen-pol'); ?></p>
                        </div>
                        <div class="info-card">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/truck.svg'); ?>" alt="<?php esc_attr_e('Wysyłka w 2 dni', 'pen-pol'); ?>" class="info-card-icon">
                            <p><?php esc_html_e('Wysyłka w 2 dni', 'pen-pol'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs section -->
    <div class="product-tabs-container">
        <div class="product-tabs-container-inner">
            <?php
            // Przygotowanie zakładek
            $product_description = $product->get_description();
            
            // Generate technical data content
            $technical_data_content = '';
            $technical_data_content .= '<div class="technical-data-table">';
            $technical_data_content .= '<table>';
            
            // Pobierz wszystkie atrybuty produktu
            $attributes = $product->get_attributes();
            
            if (!empty($attributes)) {
                foreach ($attributes as $attribute) {
                    $attribute_name = '';
                    $attribute_value = '';
                    
                    if ($attribute->is_taxonomy()) {
                        $attribute_name = wc_attribute_label($attribute->get_name());
                        $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), 'all');
                        $term_names = array();
                        foreach ($terms as $term) {
                            $term_names[] = $term->name;
                        }
                        $attribute_value = implode(', ', $term_names);
                    } else {
                        $attribute_name = $attribute->get_name();
                        $attribute_value = $attribute->get_options();
                        if (is_array($attribute_value)) {
                            $attribute_value = implode(', ', $attribute_value);
                        }
                    }
                    
                    if (!empty($attribute_name) && !empty($attribute_value)) {
                        $technical_data_content .= '<tr><td><strong>' . esc_html($attribute_name) . '</strong></td><td>' . esc_html($attribute_value) . '</td></tr>';
                    }
                }
            }
            
            // Kod producenta
            $manufacturer_code = $product->get_sku() ?: '';
            if ($manufacturer_code) {
                $technical_data_content .= '<tr><td><strong>' . esc_html__('Kod producenta', 'pen-pol') . '</strong></td><td>' . esc_html($manufacturer_code) . '</td></tr>';
            }
            
            // EAN
            $ean = get_post_meta($product->get_id(), '_ean', true) ?: esc_html__('brak', 'pen-pol');
            $technical_data_content .= '<tr><td><strong>' . esc_html__('EAN (GTIN)', 'pen-pol') . '</strong></td><td>' . esc_html($ean) . '</td></tr>';
            
            $technical_data_content .= '</table>';
            $technical_data_content .= '</div>';
            
            // Generowanie zawartości dla zakładki opinii
            // Jeśli używasz systemu opinii WooCommerce
            ob_start();
            comments_template();
            $reviews_content = ob_get_clean();
            
            // Przygotowanie tablicy zakładek
            $product_tabs = [
                'opis-produktu' => [
                    'title' => esc_html__('Opis produktu', 'pen-pol'),
                    'content' => $product_description ?: esc_html__('Brak opisu produktu.', 'pen-pol')
                ],
                'dane-techniczne' => [
                    'title' => esc_html__('Dane techniczne', 'pen-pol'),
                    'content' => $technical_data_content
                ],
                'opinie' => [
                    'title' => esc_html__('Opinie', 'pen-pol'),
                    'content' => $reviews_content
                ]
            ];
            
            // Aktywna zakładka
            $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'opis-produktu';
            ?>
            
            <!-- Nawigacja zakładek -->
            <div class="product-tabs-nav">
                <?php foreach ($product_tabs as $tab_id => $tab) : ?>
                <button class="product-tab-button <?php echo $active_tab === $tab_id ? 'active' : ''; ?>"
                    data-tab="<?php echo esc_attr($tab_id); ?>">
                    <?php echo esc_html($tab['title']); ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Zawartość zakładek -->
            <section class="product-tabs-content">
                <?php foreach ($product_tabs as $tab_id => $tab) : ?>
                <div class="product-tab-content <?php echo $active_tab === $tab_id ? 'active' : ''; ?>"
                    id="tab-<?php echo esc_attr($tab_id); ?>">
                    <div class="tab-content-inner">
                        <?php echo $tab['content']; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </div>
    </div>

    <!-- Related products section -->
    <section class="related-section">
        <div class="related-header">
            <div>
                <h3><?php esc_html_e('Inne produkty', 'pen-pol'); ?></h3>
                <h2><?php esc_html_e('Ostatnio oglądane', 'pen-pol'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn--link btn--link--dark">
                <span class="btn__text"><?php esc_html_e('Zobacz wszystkie', 'pen-pol'); ?></span>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black.svg'); ?>" alt="" class="btn__icon">
            </a>
        </div>
        
        <div class="related-products-container">
            <?php
            // Własne query dla produktów powiązanych
            $current_product_id = get_the_ID();
            
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'post__not_in' => array($current_product_id),
                'orderby' => 'rand'
            );
            
            $related_query = new WP_Query($args);
            
            if ($related_query->have_posts()) : ?>
                <div class="related-products">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                        // Używamy własnego szablonu karty produktu
                        get_template_part('woocommerce/content-product');
                    endwhile; 
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php endwhile; ?>

    <?php
    /**
     * Hook: woocommerce_after_main_content.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');
    ?>

    <script>
    jQuery(document).ready(function($) {
        // Sprawdź, czy skrypt ulubionych został załadowany
        if (typeof pen_pol_favorites !== 'undefined') {
            console.log('Skrypt ulubionych został załadowany');
            
            // Dodaj obsługę kliknięcia dla przycisku ulubionych na stronie produktu
            $('.fav-icon .add-to-favorites').on('click', function(e) {
                e.preventDefault();
                console.log('Kliknięto przycisk ulubionych');
                console.log('Product ID:', $(this).data('product-id'));
                
                // Tutaj można dodać logikę dodawania do ulubionych
                // która zazwyczaj znajduje się w favourites.js
            });
        } else {
            console.log('Skrypt ulubionych NIE został załadowany');
        }
    });
    </script>
</main>

<?php
get_footer('shop');
?>