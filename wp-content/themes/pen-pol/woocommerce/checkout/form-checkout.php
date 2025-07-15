<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<div class="checkout">
		<div class="checkout__main">
			<div class="checkout__main--inner">
			
			<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout" style="display: none;"></div>

				<?php if ( $checkout->get_checkout_fields() ) : ?>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div id="customer_details">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				<?php endif; ?>

				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
					<div class="checkout__section checkout__section--shipping">
						<h3 class="checkout__section-title"><?php esc_html_e( 'Shipping method', 'woocommerce' ); ?></h3>
						<div class="checkout__shipping-refresh">
							<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
							<?php wc_cart_totals_shipping_html(); ?>
							<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="checkout__section checkout__section--payment">
					<h3 class="checkout__section-title"><?php esc_html_e( 'Payment method', 'woocommerce' ); ?></h3>
					<?php woocommerce_checkout_payment(); ?>
				</div>

			</div>
		</div>

		<div class="checkout__summary">
			<div class="checkout__summary--inner">
				<div class="checkout__section checkout__section--summary">

					<div class="checkout__actions">
						<?php if ( ! is_user_logged_in() ) : ?>
							<button type="button" class="btn-login-toggle">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								<?php esc_html_e( 'Zaloguj się', 'woocommerce' ); ?>
							</button>
						<?php endif; ?>
						
						<?php if ( wc_coupons_enabled() ) : ?>
							<button type="button" class="btn-coupon-toggle">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
								<?php esc_html_e( 'Dodaj kod rabatowy', 'woocommerce' ); ?>
							</button>
						<?php endif; ?>
					</div>
			
					<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
					
					<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
					
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

				</div>
			</div>
		</div>
	</div>

</form>

<!-- Login Popup -->
<div class="checkout-popup checkout-popup--login">
    <div class="checkout-popup__overlay"></div>
    <div class="checkout-popup__content">
        <button type="button" class="checkout-popup__close">&times;</button>
        <div class="popup-form-container"></div>
    </div>
</div>

<!-- Coupon Popup -->
<div class="checkout-popup checkout-popup--coupon">
    <div class="checkout-popup__overlay"></div>
    <div class="checkout-popup__content">
        <button type="button" class="checkout-popup__close">&times;</button>
        <div class="popup-form-container"></div>
    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>