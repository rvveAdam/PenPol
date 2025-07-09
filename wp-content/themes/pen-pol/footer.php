<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pen-pol
 */

// Pobieramy dane z grupy "ogolne"
$ogolne_grupa = get_field('ogolne', 'option');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-background" aria-hidden="true"></div>
		
		<div class="footer-top">
			<div class="container">
				<div class="footer-widgets">
					<!-- Logo -->
					<div class="footer-widget footer-widget--logo">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" rel="home">
							<img src="<?php echo esc_url('/wp-content/uploads/2025/07/logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
						</a>
					</div>

					<!-- Kontakt -->
					<div class="footer-widget footer-widget--contact">
						<h3 class="footer-widget__title">KONTAKT</h3>
						<ul class="footer-contact">
							<?php if (!empty($ogolne_grupa['ogolne_email'])) : ?>
							<li class="footer-contact__item">
								<a href="mailto:<?php echo esc_attr($ogolne_grupa['ogolne_email']); ?>" class="footer-contact__link footer-contact__link--mail">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/envelope.svg'); ?>" alt="" class="footer-contact__icon" aria-hidden="true">
									<span class="footer-contact__text"><?php echo esc_html($ogolne_grupa['ogolne_email']); ?></span>
								</a>
							</li>
							<?php endif; ?>
							
							<?php if (!empty($ogolne_grupa['ogolne_numer_telefonu'])) : ?>
							<li class="footer-contact__item">
								<a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $ogolne_grupa['ogolne_numer_telefonu'])); ?>" class="footer-contact__link footer-contact__link--phone">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/phone.svg'); ?>" alt="" class="footer-contact__icon" aria-hidden="true">
									<span class="footer-contact__text"><?php echo esc_html($ogolne_grupa['ogolne_numer_telefonu']); ?></span>
								</a>
							</li>
							<?php endif; ?>
						</ul>
					</div>

					<!-- Moje konto -->
					<div class="footer-widget footer-widget--menu">
						<h3 class="footer-widget__title">MOJE KONTO</h3>
						<?php
						wp_nav_menu(
							array(
								'menu'           => 16,
								'menu_id'        => 'account-menu',
								'container'      => 'nav',
								'container_class' => 'footer-nav footer-nav--account',
								'theme_location' => 'footer-account',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</div>

					<!-- Regulaminy -->
					<div class="footer-widget footer-widget--menu">
						<h3 class="footer-widget__title">REGULAMINY</h3>
						<?php
						wp_nav_menu(
							array(
								'menu'           => 17,
								'menu_id'        => 'legal-menu',
								'container'      => 'nav',
								'container_class' => 'footer-nav footer-nav--legal',
								'theme_location' => 'footer-legal',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</div>

					<!-- Inne -->
					<div class="footer-widget footer-widget--menu">
						<h3 class="footer-widget__title">INNE</h3>
						<?php
						wp_nav_menu(
							array(
								'menu'           => 18,
								'menu_id'        => 'other-menu',
								'container'      => 'nav',
								'container_class' => 'footer-nav footer-nav--other',
								'theme_location' => 'footer-other',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</div>

					<!-- Social Media -->
					<div class="footer-widget footer-widget--social">
						<ul class="footer-social">
							<?php if (!empty($ogolne_grupa['ogolne_fb'])) : ?>
							<li class="footer-social__item">
								<a href="<?php echo esc_url($ogolne_grupa['ogolne_fb']); ?>" class="footer-social__link" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
									<svg class="footer-social__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 5 3.66 9.15 8.44 9.9v-7H7.9V12h2.54V9.79c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.45 2.89h-2.33v7A10 10 0 0022 12z" fill="currentColor"/>
									</svg>
								</a>
							</li>
							<?php endif; ?>
							
							<?php if (!empty($ogolne_grupa['ogolne_ig'])) : ?>
							<li class="footer-social__item">
								<a href="<?php echo esc_url($ogolne_grupa['ogolne_ig']); ?>" class="footer-social__link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
									<svg class="footer-social__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.509.5.902 1.105 1.153 1.772.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772c-.5.508-1.105.902-1.772 1.153-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.897 4.897 0 015.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 1.802c-2.67 0-2.986.01-4.04.059-.976.045-1.505.207-1.858.344-.466.181-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.048 1.055-.058 1.37-.058 4.04 0 2.67.01 2.986.058 4.04.045.977.207 1.505.344 1.858.181.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.04.058 2.67 0 2.987-.01 4.04-.058.977-.045 1.505-.207 1.858-.344.466-.181.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.04 0-2.67-.01-2.986-.058-4.04-.045-.977-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.055-.048-1.37-.058-4.04-.058zm0 3.063a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 8.468a3.333 3.333 0 100-6.666 3.333 3.333 0 000 6.666zm6.538-8.671a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0z" fill="currentColor"/>
									</svg>
								</a>
							</li>
							<?php endif; ?>
							
							<?php if (!empty($ogolne_grupa['ogolne_twitter-x'])) : ?>
							<li class="footer-social__item">
								<a href="<?php echo esc_url($ogolne_grupa['ogolne_twitter-x']); ?>" class="footer-social__link" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
									<svg class="footer-social__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 14-7.497 14-13.986 0-.21 0-.42-.015-.63A9.936 9.936 0 0024 4.59l-.047-.02z" fill="currentColor"/>
									</svg>
								</a>
							</li>
							<?php endif; ?>
							
							<?php if (!empty($ogolne_grupa['ogolne_linkedin'])) : ?>
							<li class="footer-social__item">
								<a href="<?php echo esc_url($ogolne_grupa['ogolne_linkedin']); ?>" class="footer-social__link" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
									<svg class="footer-social__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" fill="currentColor"/>
									</svg>
								</a>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="footer-copyright">
					<p class="footer-copyright__text">Pen-Pol © 2025. All Rights Reserved</p>
					<p class="footer-copyright__credits">Realizacja: <a href="https://invette.dev" class="footer-copyright__link" target="_blank" rel="noopener noreferrer">Invette.dev</a></p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>