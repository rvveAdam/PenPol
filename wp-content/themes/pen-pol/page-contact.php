<?php
/**
 * Template Name: Strona Kontaktowa
 * 
 * Szablon dla strony kontaktowej z formularzem oraz sekcją FAQ.
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

get_header();

// Pobieramy dane z grupy "kontakt" - analogicznie jak w footer.php
$kontakt_grupa = get_field('kontakt', 'option');
?>

<main id="primary" class="site-main">
    <section class="contact" aria-labelledby="contact-heading">
        <div class="container">
            <div class="contact__content">
                <div class="contact__info">
                    <h1 id="contact-heading" class="contact__heading">Skontaktuj się z nami</h1>
                    <p class="contact__text">
                        Masz pytania dotyczące naszych produktów, zamówień lub współpracy?
                        Jesteśmy do Twojej dyspozycji – chętnie doradzimy i pomożemy w wyborze idealnej pościeli.
                    </p>
                    
                    <div class="contact__details">
                        <?php if (!empty($kontakt_grupa['kontakt_email'])) : ?>
                        <div class="contact__detail">
                            <div class="contact__icon">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/kontakt-email.svg'); ?>" 
                                     alt="" 
                                     aria-hidden="true"
                                     width="24" 
                                     height="24">
                            </div>
                            <a href="mailto:<?php echo esc_attr($kontakt_grupa['kontakt_email']); ?>" class="contact__link">
                                <?php echo esc_html($kontakt_grupa['kontakt_email']); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($kontakt_grupa['kontakt_numer_telefonu'])) : ?>
                        <div class="contact__detail">
                            <div class="contact__icon">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/kontakt-telefon.svg'); ?>" 
                                     alt="" 
                                     aria-hidden="true"
                                     width="24" 
                                     height="24">
                            </div>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $kontakt_grupa['kontakt_numer_telefonu'])); ?>" class="contact__link">
                                <?php echo esc_html($kontakt_grupa['kontakt_numer_telefonu']); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="contact__form">
                    <h2 class="contact__form-heading">Formularz kontaktowy</h2>
                    <p class="contact__form-text">Masz pytanie? Napisz do nas, odpowiemy w ciągu 48h</p>
                    
                    <div class="contact__form-wrapper">
                        <?php 
                        if (shortcode_exists('wpforms')) {
                            echo do_shortcode('[wpforms id="267"]');
                        } else {
                            echo '<p class="contact__error">Formularz kontaktowy jest chwilowo niedostępny. Prosimy o kontakt mailowy lub telefoniczny.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
    // Dołączamy komponent FAQ
    get_template_part('template-parts/global/faq');
    ?>

</main>

<?php
get_footer();