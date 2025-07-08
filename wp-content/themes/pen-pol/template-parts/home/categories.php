<?php
/**
 * Template Part: Categories Section
 * 
 * Displays product categories grid with text content and CTA
 * Uses ACF fields: sg-kategorie group
 * Location: template-parts/categories.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$categories_data = get_field('sg-kategorie');

if (!$categories_data) {
    return;
}

$subheader = $categories_data['sg-kategorie_podnaglowek'] ?? '';
$heading = $categories_data['sg-kategorie_naglowek'] ?? '';
$button_url = $categories_data['sg-kategorie_button-url'] ?? '';
$button_text = $categories_data['sg-kategorie_button-text'] ?? 'Odkryj wszystkie kategorie';
$products = $categories_data['sg-kategorie-produkty'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($heading) && empty($products)) {
    return;
}
?>

<section class="categories-wrapper" aria-labelledby="categories-heading">
    <div class="categories-container">
        <div class="categories">
            
            <?php if (!empty($subheader) || !empty($heading) || !empty($button_url)) : ?>
            <header class="categories__content-header">
                <?php if (!empty($subheader)) : ?>
                <p class="categories__subheader"><?php echo esc_html($subheader); ?></p>
                <?php endif; ?>
                
                <?php if (!empty($heading)) : ?>
                <h2 id="categories-heading" class="categories__heading">
                    <?php echo wp_kses_post($heading); ?>
                </h2>
                <?php endif; ?>
                
                <?php if (!empty($button_url)) : ?>
                <div class="categories__cta">
                    <a href="<?php echo esc_url($button_url); ?>" 
                       class="btn btn--link btn--link--dark"
                       aria-describedby="categories-heading">
                        <span class="btn__text"><?php echo esc_html($button_text); ?></span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                    </a>
                </div>
                <?php endif; ?>
            </header>
            <?php endif; ?>
            
            <?php if (!empty($products)) : ?>
            <div class="categories__grid-wrapper">
                <div class="categories__grid" role="group" aria-label="Kategorie produktów">
                <?php 
                // Ograniczenie do maksymalnie 4 produktów dla układu 2x2
                $products = array_slice($products, 0, 4);
                
                foreach ($products as $index => $product) : 
                    $product_title = $product['sg-kategorie-produkty-naglowek'] ?? '';
                    $product_link = $product['sg-kategorie_produkty-link'] ?? '';
                    $product_image = $product['sg-kategorie_produkty-zdjecie'] ?? null;
                    
                    // Pomijamy puste produkty
                    if (empty($product_title)) {
                        continue;
                    }
                    
                    // Określenie czy kafelek ma obrazek
                    $has_image = !empty($product_image);
                    $tile_class = $has_image ? 'categories__tile--with-image' : 'categories__tile--default';
                    
                    // Struktura HTML - zawsze link, nawet jeśli pusty (dla spójności layoutu)
                    $is_clickable = !empty($product_link);
                    $link_class = $is_clickable ? '' : 'categories__tile-link--disabled';
                    
                    // ARIA labels
                    $tile_id = 'category-tile-' . ($index + 1);
                ?>
                
                <article class="categories__tile <?php echo esc_attr($tile_class); ?>" id="<?php echo esc_attr($tile_id); ?>">
                    <?php if ($is_clickable) : ?>
                    <a href="<?php echo esc_url($product_link); ?>" 
                       class="categories__tile-link"
                       aria-labelledby="<?php echo esc_attr($tile_id); ?>-title">
                    <?php else : ?>
                    <div class="categories__tile-link <?php echo esc_attr($link_class); ?>">
                    <?php endif; ?>
                    
                        <?php if ($has_image) : ?>
                        <div class="categories__tile-background">
                            <?php 
                            // ACF zwraca ID jako int, nie array
                            $image_id = is_array($product_image) ? $product_image['ID'] : $product_image;
                            $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                            if (empty($image_alt)) {
                                $image_alt = sprintf(__('Kategoria: %s', 'pen-pol'), $product_title);
                            }
                            
                            echo wp_get_attachment_image(
                                $image_id,
                                'large',
                                false,
                                [
                                    'class' => 'categories__tile-image',
                                    'alt' => esc_attr($image_alt),
                                    'loading' => $index < 2 ? 'eager' : 'lazy', // Tylko pierwsze 2 ładowane eager
                                    'decoding' => 'async',
                                    'fetchpriority' => $index < 2 ? 'high' : 'auto' // Priorytet dla pierwszych 2 obrazków
                                ]
                            );
                            ?>
                        </div>
                        <div class="categories__tile-overlay" aria-hidden="true"></div>
                        <?php endif; ?>
                        
                        <div class="categories__tile-content">
                            <h3 id="<?php echo esc_attr($tile_id); ?>-title" class="categories__tile-title">
                                <?php echo wp_kses_post($product_title); ?>
                            </h3>
                        </div>
                        
                    <?php if ($is_clickable) : ?>
                    </a>
                    <?php else : ?>
                    </div>
                    <?php endif; ?>
                </article>
                
                <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>