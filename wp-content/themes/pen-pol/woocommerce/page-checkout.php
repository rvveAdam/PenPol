<?php
/**
 * Template Name: Checkout Page
 */

get_header();
?>

<div class="checkout-page">
    <header class="checkout-header">
        <div class="checkout-header__main">
            <div class="checkout-header__main--inner">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        echo wp_get_attachment_image($custom_logo_id, 'full', false, ['class' => 'checkout-header__logo-img']);
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.svg" alt="' . get_bloginfo('name') . '" class="checkout-header__logo-img">';
                    }
                    ?>
                </a>
            </div>
        </div>

        <div class="checkout-header__right">
            <div class="checkout-header__right--inner">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="checkout-header__cart-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 7.67001V6.70001C7.5 4.45001 9.31 2.24001 11.56 2.03001C14.24 1.77001 16.5 3.88001 16.5 6.51001V7.89001" stroke="#212121" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.0008 22H15.0008C19.0208 22 19.7408 20.39 19.9508 18.43L20.7008 12.43C20.9708 9.99 20.2708 8 16.0008 8H8.0008C3.7308 8 3.0308 9.99 3.3008 12.43L4.0508 18.43C4.2608 20.39 4.9808 22 9.0008 22Z" stroke="#212121" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.4941 12H15.5031" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.49414 12H8.50312" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <main class="checkout-content">
        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
    </main>

    <footer class="checkout-footer">
        <div class="checkout-footer__container">
            <div class="checkout-footer__links">
                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="checkout-footer__link">
                    Polityka Prywatności
                </a>
                <a href="/regulamin" class="checkout-footer__link">
                    Regulamin
                </a>
            </div>
        </div>
    </footer>
</div>

<?php
get_footer();
?>
