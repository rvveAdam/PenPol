<?php
/**
 * Template Name: Porównywarka
 * 
 * Szablon dla strony porównującej produkty
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

get_header();

// Pobierz produkty z sesji lub parametrów URL
$compare_products = array();
if (isset($_SESSION['compare_products'])) {
    $compare_products = $_SESSION['compare_products'];
} elseif (isset($_GET['products'])) {
    $product_ids = explode(',', sanitize_text_field($_GET['products']));
    $compare_products = array_slice($product_ids, 0, 3); // Max 3 produkty
}

// Usuń nieistniejące produkty
$compare_products = array_filter($compare_products, function($id) {
    return get_post_status($id) === 'publish';
});

$product_objects = array();
foreach ($compare_products as $product_id) {
    $product = wc_get_product($product_id);
    if ($product) {
        $product_objects[] = $product;
    }
}

// Przygotuj standardowe atrybuty do wyświetlenia
$standard_attributes = array(
    'short_description' => __('Krótki opis', 'pen-pol'),
    'rozmiar' => __('Rozmiar', 'pen-pol'), 
    'wsad_wypelnienie' => __('Wsad/wypełnienie', 'pen-pol'),
    'waga_wsadu' => __('Waga wsadu', 'pen-pol'),
    'poszycie' => __('Poszycie', 'pen-pol'),
    'kolor' => __('Kolor', 'pen-pol'),
    'pozycja_spania' => __('Pozycja spania', 'pen-pol')
);

// Pobierz wszystkie atrybuty z produktów
$all_attributes = array();
foreach ($product_objects as $product) {
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) {
        $name = $attribute->get_name();
        if (!isset($all_attributes[$name])) {
            $all_attributes[$name] = wc_attribute_label($name);
        }
    }
}

// Połącz standardowe z dostępnymi atrybutami
$all_display_attributes = array_merge($standard_attributes, $all_attributes);

// Funkcja do pobierania wartości atrybutu
function get_product_attribute_value($product, $attr_key) {
    if ($attr_key === 'short_description') {
        return $product->get_short_description();
    } else {
        $attributes = $product->get_attributes();
        if (isset($attributes[$attr_key])) {
            $attribute = $attributes[$attr_key];
            if ($attribute->is_taxonomy()) {
                $terms = wp_get_post_terms($product->get_id(), $attribute->get_name());
                return implode(', ', wp_list_pluck($terms, 'name'));
            } else {
                return implode(', ', $attribute->get_options());
            }
        }
    }
    return '';
}

// Sprawdź czy atrybut ma różne wartości między produktami
function has_attribute_differences($products, $attr_key) {
    $values = array();
    foreach ($products as $product) {
        $value = get_product_attribute_value($product, $attr_key);
        if (!empty($value)) {
            $values[] = $value;
        }
    }
    return count(array_unique($values)) > 1;
}

// Pokaż wszystkie atrybuty
$display_attributes = $all_display_attributes;
?>

<main id="primary" class="site-main">
    <section class="porownywarka-table-layout">
        <div class="porownywarka-header">
            <h1><?php _e('Porównywarka produktów', 'pen-pol'); ?></h1>
            <p><?php _e('Zaznacz produkty, które chcesz porównać', 'pen-pol'); ?></p>
        </div>

        <?php if (empty($product_objects)): ?>
        <!-- Pusty stan -->
        <div class="empty-compare-state">
            <h3><?php _e('Ups! nie wybrałeś żadnych produktów do porównania.', 'pen-pol'); ?></h3>
            <p><?php _e('Wybierz kategorię produktów i zaznacz min. 2 produkty, aby je porównać.', 'pen-pol'); ?></p>
        </div>

        <?php else: ?>

        <!-- Tabela porównawcza -->
        <div class="compare-table">
            <!-- Wiersz z produktami -->
            <div class="products-table-row">
                <div class="row-label-cell">
                    <h2><?php printf(__('Wybrane produkty: (%d/3)', 'pen-pol'), count($product_objects)); ?></h2>
                    <div class="compare-differents">
                        <div class="point"></div>
                        <p><?php _e('Różnice', 'pen-pol'); ?></p>
                    </div>
                </div>

                <?php 
                // Zawsze wyświetl 3 kolumny
                for ($i = 0; $i < 3; $i++): 
                    if (isset($product_objects[$i])): 
                        $product = $product_objects[$i];
                        
                        // Prawidłowe ustawienie globalnych zmiennych
                        global $post, $product;
                        $post = get_post($product->get_id());
                        $GLOBALS['post'] = $post;
                        $GLOBALS['product'] = $product;
                        setup_postdata($post);
                ?>
                <div class="product-table-cell">
                    <div class="product-header-compare">
                        <?php wc_get_template_part('content', 'product'); ?>

                        <!-- Dodatkowe akcje specyficzne dla porównywarki -->
                        <div class="compare-specific-actions">
                            <a href="#" class="remove-product-btn" data-product-id="<?php echo $product->get_id(); ?>"
                                title="<?php esc_attr_e('Usuń z porównania', 'pen-pol'); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/trash.svg"
                                    alt="<?php esc_attr_e('Usuń', 'pen-pol'); ?>">
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                        wp_reset_postdata();
                    else: 
                ?>
                <div class="product-table-cell empty-cell">
                    <div class="add-product-placeholder">
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="add-product-large"
                            title="<?php esc_attr_e('Dodaj produkt do porównania', 'pen-pol'); ?>">
                            <div class="plus-icon">+</div>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endfor; ?>
            </div>

            <!-- Wiersze z atrybutami -->
            <?php foreach ($display_attributes as $attr_key => $attr_label): ?>
            <?php $has_differences = has_attribute_differences($product_objects, $attr_key); ?>
            <div class="attribute-table-row <?php echo $has_differences ? 'has-differences' : ''; ?>">
                <div class="row-label-cell">
                    <span class="attribute-name"><?php echo esc_html($attr_label); ?></span>
                </div>

                <?php 
                // Wartości dla każdego produktu
                for ($i = 0; $i < 3; $i++): 
                    if (isset($product_objects[$i])): 
                        $product = $product_objects[$i];
                        $value = get_product_attribute_value($product, $attr_key);
                ?>
                <div class="attribute-value-cell">
                    <span
                        class="attribute-value <?php echo ($has_differences && $attr_key !== 'short_description') ? 'different' : ''; ?>">
                        <?php echo !empty($value) ? esc_html($value) : '—'; ?>
                    </span>
                </div>
                <?php else: ?>
                <div class="attribute-value-cell empty-cell">
                    <span class="attribute-value">—</span>
                </div>
                <?php endif; ?>
                <?php endfor; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>
</main>

<script>
// Przekaż dane do JavaScript
window.compareData = {
    ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('compare_products_nonce'); ?>',
    maxProducts: 3,
    currentProducts: <?php echo json_encode(array_map(function($p) { return $p->get_id(); }, $product_objects)); ?>,
    // Dodaj tłumaczenia dla JavaScript
    translations: {
        confirmRemove: '<?php echo esc_js(__('Czy na pewno chcesz usunąć ten produkt z porównania?', 'pen-pol')); ?>',
        maxProductsReached: '<?php echo esc_js(__('Możesz porównać maksymalnie 3 produkty.', 'pen-pol')); ?>',
        productRemoved: '<?php echo esc_js(__('Produkt został usunięty z porównania.', 'pen-pol')); ?>',
        addProduct: '<?php echo esc_js(__('Dodaj produkt', 'pen-pol')); ?>',
        noProducts: '<?php echo esc_js(__('Brak produktów do porównania', 'pen-pol')); ?>'
    }
};
</script>

<?php
get_footer();
?>