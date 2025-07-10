<?php
/**
 * Template Part: FAQ Section
 * 
 * Displays accordion with FAQ items
 * Uses ACF fields from sg_faq group or kontakt group
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Próbujemy pobrać dane ACF ze strony głównej
$faq_data = get_field('sg_faq');
$naglowek = '';
$pytania = [];

if ($faq_data) {
    // Dane ze strony głównej
    $naglowek = $faq_data['sg_faq-naglowek'] ?? '';
    $pytania = $faq_data['sg_faq-pp'] ?? [];
} else {
    // Dane z pól kontaktowych - pobieramy całą grupę, tak jak w footer.php
    $kontakt_grupa = get_field('kontakt', 'option');
    
    if ($kontakt_grupa) {
        $naglowek = $kontakt_grupa['kontakt_naglowek-faq'] ?? '';
        $pytania = $kontakt_grupa['kontakt_faq-pp'] ?? [];
    }
}

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($naglowek) && empty($pytania)) {
    return;
}

// Generowanie unikalnego ID dla akordeonu
$accordion_id = 'faq-accordion-' . uniqid();
?>

<section class="faq-wrapper" aria-labelledby="faq-heading">
    <div class="container">
        <?php if (!empty($naglowek)) : ?>
        <div class="faq-header">
            <h2 id="faq-heading" class="faq-header__heading">
                <?php echo wp_kses_post($naglowek); ?>
            </h2>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($pytania)) : ?>
        <div class="faq-content">
            <div class="faq-accordion" id="<?php echo esc_attr($accordion_id); ?>">
                <?php foreach ($pytania as $index => $pytanie) : 
                    // Sprawdzamy, które pola mamy dostępne (ze strony głównej czy opcji)
                    if (isset($pytanie['sg_faq-pp-pytanie'])) {
                        $pytanie_text = $pytanie['sg_faq-pp-pytanie'] ?? '';
                        $odpowiedz_text = $pytanie['sg_faq-pp-odpowiedz'] ?? '';
                    } else {
                        $pytanie_text = $pytanie['kontakt_faq-pytanie'] ?? '';
                        $odpowiedz_text = $pytanie['kontakt_faq-odpowiedz'] ?? '';
                    }
                    
                    if (empty($pytanie_text)) continue;
                    
                    $item_id = 'faq-item-' . sanitize_title($pytanie_text) . '-' . $index;
                    $panel_id = 'faq-panel-' . sanitize_title($pytanie_text) . '-' . $index;
                ?>
                <div class="faq-accordion__item">
                    <button 
                        class="faq-accordion__button" 
                        id="<?php echo esc_attr($item_id); ?>"
                        aria-expanded="false"
                        aria-controls="<?php echo esc_attr($panel_id); ?>"
                    >
                        <span class="faq-accordion__question"><?php echo esc_html($pytanie_text); ?></span>
                        <span class="faq-accordion__icon" aria-hidden="true">
                            <img 
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/plus.svg'); ?>" 
                                class="faq-accordion__icon-plus" 
                                alt="" 
                                aria-hidden="true"
                            >
                            <img 
                                src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/minus-2.svg'); ?>" 
                                class="faq-accordion__icon-minus" 
                                alt="" 
                                aria-hidden="true"
                            >
                        </span>
                    </button>
                    <div 
                        id="<?php echo esc_attr($panel_id); ?>" 
                        class="faq-accordion__panel"
                        aria-labelledby="<?php echo esc_attr($item_id); ?>"
                        hidden
                    >
                        <div class="faq-accordion__answer">
                            <?php echo wp_kses_post($odpowiedz_text); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>