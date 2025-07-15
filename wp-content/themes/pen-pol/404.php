<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Pen-pol
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found" aria-labelledby="error-heading">
        <div class="error-404__container">
            <div class="error-404__content">
                <div class="error-404__text">
                    <h1 id="error-heading" class="error-404__title">404</h1>
                    <p class="error-404__message">
                        <span class="error-404__message-primary">Ta strona zwinęła się</span>
                        <span class="error-404__message-secondary">w kołdrę i zasnęła.</span>
                    </p>
                    <p class="error-404__description">Strona, której szukasz, nie jest dostępna.</p>
                    
                    <div class="error-404__buttons">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--with-icon">
                            <span class="btn__text">Strona główna</span>
                            <span class="btn__icon">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                    <path d="M3.64645 11.3536C3.45118 11.1583 3.45118 10.8417 3.64645 10.6465L10.2929 4L6 4C5.72386 4 5.5 3.77614 5.5 3.5C5.5 3.22386 5.72386 3 6 3L11.5 3C11.7761 3 12 3.22386 12 3.5L12 9C12 9.27614 11.7761 9.5 11.5 9.5C11.2239 9.5 11 9.27614 11 9L11 4.70711L4.35355 11.3536C4.15829 11.5488 3.84171 11.5488 3.64645 11.3536Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn btn--link btn--link--dark btn--with-icon">
                            <span class="btn__text">Sklep</span>
                            <span class="btn__icon">
                                <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                    <path d="M3.64645 11.3536C3.45118 11.1583 3.45118 10.8417 3.64645 10.6465L10.2929 4L6 4C5.72386 4 5.5 3.77614 5.5 3.5C5.5 3.22386 5.72386 3 6 3L11.5 3C11.7761 3 12 3.22386 12 3.5L12 9C12 9.27614 11.7761 9.5 11.5 9.5C11.2239 9.5 11 9.27614 11 9L11 4.70711L4.35355 11.3536C4.15829 11.5488 3.84171 11.5488 3.64645 11.3536Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="error-404__image">
                <?php 
                // Użycie obrazka z nowej lokalizacji
                $image_path = get_template_directory_uri() . '/assets/images/404/404.png';
                ?>
                <img src="<?php echo esc_url($image_path); ?>" alt="Zwinięta kołdra symbolizująca nieznalezioną stronę" width="600" height="400" loading="eager" decoding="async">
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();