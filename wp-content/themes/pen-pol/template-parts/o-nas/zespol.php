<?php
/**
 * Template Part: Team Section
 * 
 * Displays the "Zespół" section with text content, team image and info cards
 * Uses ACF fields: o_nas-zespol group
 * Location: template-parts/zespol.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$team_data = get_field('o_nas-zespol');

if (!$team_data) {
    return;
}

$subheading = $team_data['o_nas-zespol-subnaglowek'] ?? '';
$heading = $team_data['o_nas-zespol-naglowek'] ?? '';
$text = $team_data['o_nas-zespol-opis'] ?? '';
$image = $team_data['o_nas-zespol-obrazek'] ?? null;
$info_cards = $team_data['o_nas-zespol-karty'] ?? [];

// Sprawdzenie czy mamy wystarczające dane do wyświetlenia
if (empty($heading) && empty($text) && empty($image) && empty($info_cards)) {
    return;
}
?>

<section class="team" aria-labelledby="team-heading">
    <div class="team__wrapper">
        <div class="team__container">
            
            <?php if (!empty($subheading) || !empty($heading) || !empty($text) || !empty($image)) : ?>
            <div class="team__top">
                
                <?php if (!empty($subheading) || !empty($heading) || !empty($text)) : ?>
                <div class="team__content">
                    <?php if (!empty($subheading)) : ?>
                    <p class="team__subheading">
                        <?php echo wp_kses_post($subheading); ?>
                    </p>
                    <?php endif; ?>
                    
                    <?php if (!empty($heading)) : ?>
                    <h2 id="team-heading" class="team__heading">
                        <?php echo wp_kses_post($heading); ?>
                    </h2>
                    <?php endif; ?>
                    
                    <?php if (!empty($text)) : ?>
                    <div class="team__text">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($image)) : ?>
                <div class="team__images">
                    <?php 
                        $image_id = is_array($image) ? $image['ID'] : $image;
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        if (empty($image_alt)) {
                            $image_alt = __('Zespół - zdjęcie grupowe', 'pen-pol');
                        }
                    ?>
                    <div class="team__image-wrapper">
                        <?php echo wp_get_attachment_image(
                            $image_id,
                            'medium_large',
                            false,
                            [
                                'class' => 'team__image',
                                'alt' => esc_attr($image_alt),
                                'loading' => 'eager',
                                'decoding' => 'async',
                                'fetchpriority' => 'high'
                            ]
                        ); ?>
                    </div>
                </div>
                <?php endif; ?>
                
            </div>
            <?php endif; ?>
            
            <?php if (!empty($info_cards)) : ?>
            <div class="team__bottom">
                <div class="team__cards">
                    <?php 
                    foreach ($info_cards as $index => $card) : 
                        $card_title = $card['o_nas-zespol-karty-naglowek'] ?? '';
                        $card_text = $card['o_nas-zespol-karty-opis'] ?? '';
                        
                        if (empty($card_title) && empty($card_text)) {
                            continue;
                        }
                        
                        // Zmienianie koloru co drugi kafelek (nieparzyste niebieskie, parzyste białe)
                        $card_class = ($index % 2 === 0) ? 'team__card--blue' : 'team__card--white';
                        $card_id = 'team-card-' . ($index + 1);
                    ?>
                    <div class="team__card <?php echo esc_attr($card_class); ?>" id="<?php echo esc_attr($card_id); ?>">
                        <?php if (!empty($card_title)) : ?>
                        <h3 class="team__card-title">
                            <?php echo wp_kses_post($card_title); ?>
                        </h3>
                        <?php endif; ?>
                        
                        <?php if (!empty($card_text)) : ?>
                        <div class="team__card-text">
                            <?php echo wp_kses_post($card_text); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>