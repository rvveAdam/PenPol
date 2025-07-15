<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pen-pol
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pen-pol' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper">
			<div class="container">
				<div class="header-content">
					<!-- Logo -->
					<div class="site-branding">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
							<img src="<?php echo esc_url('/wp-content/uploads/2025/07/logo-czarne.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="custom-logo">
						</a>
					</div><!-- .site-branding -->

					<!-- Desktop Navigation -->
					<nav id="site-navigation" class="main-navigation desktop-nav" aria-label="<?php esc_attr_e( 'Main Navigation', 'pen-pol' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'menu'           => 19,
								'container'      => false,
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'menu-wrapper',
								'theme_location' => 'menu-1',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav><!-- #site-navigation -->

					<!-- Header Icons -->
					<div class="header-icons">
						<!-- Search Icon - tylko desktop -->
						<div class="header-icon header-icon--search">
							<button class="search-toggle" aria-expanded="false" aria-controls="search-form">
								<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/lupka.svg'); ?>" alt="" aria-hidden="true">
								<span class="screen-reader-text"><?php echo esc_html__( 'Search', 'pen-pol' ); ?></span>
							</button>
							<div id="search-form" class="search-form-wrapper" hidden>
								<?php echo do_shortcode('[fibosearch]'); ?>
							</div>
						</div>

						<!-- Wishlist Icon - tylko desktop -->
						<div class="header-icon header-icon--wishlist">
							<a href="/ulubione" class="wishlist-link">
								<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/serduszko.svg'); ?>" alt="" aria-hidden="true">
								<span class="screen-reader-text"><?php echo esc_html__( 'Wishlist', 'pen-pol' ); ?></span>
							</a>
						</div>

						<!-- Account Icon - tylko desktop -->
						<div class="header-icon header-icon--account">
							<a href="/moje-konto" class="account-link">
								<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/user.svg'); ?>" alt="" aria-hidden="true">
								<span class="screen-reader-text"><?php echo esc_html__( 'My Account', 'pen-pol' ); ?></span>
							</a>
						</div>

						<!-- Separator - tylko desktop -->
						<div class="header-separator" aria-hidden="true"></div>

						<!-- Cart Icon - widoczny też na mobile -->
						<?php 
						if ( function_exists( 'pen_pol_woocommerce_header_cart' ) ) {
							pen_pol_woocommerce_header_cart();
						} else { 
						?>
							<div class="header-icon header-icon--cart">
								<a href="/koszyk" class="cart-link">
									<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/koszyk.svg'); ?>" alt="" aria-hidden="true">
									<span class="screen-reader-text"><?php echo esc_html__( 'Cart', 'pen-pol' ); ?></span>
									<span class="cart-count">0</span>
								</a>
							</div>
						<?php } ?>

						<!-- Mobile Menu Toggle -->
						<button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-controls="mobile-navigation" aria-expanded="false">
							<span class="hamburger-icon" aria-hidden="true">
								<span class="hamburger-inner"></span>
							</span>
							<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'pen-pol' ); ?></span>
						</button>
					</div><!-- .header-icons -->
				</div><!-- .header-content -->
			</div><!-- .container -->
		</div><!-- .header-wrapper -->

		<!-- Mobile Navigation - zmodyfikowane wysuwane menu -->
		<div id="mobile-navigation" class="mobile-navigation" aria-hidden="true">
			<div class="container">
				
				<div class="mobile-menu-content">
					<!-- Nawigacja mobilna -->
					<nav class="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'pen-pol' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'menu'           => 19,
								'container'      => false,
								'menu_id'        => 'mobile-menu',
								'menu_class'     => 'mobile-menu-wrapper',
								'theme_location' => 'menu-1',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>

					<!-- Pole wyszukiwania w menu mobilnym -->
					<div class="mobile-search">
						<?php echo do_shortcode('[fibosearch]'); ?>
					</div>
				</div>
				
				<!-- Ikony wyśrodkowane pod wyszukiwarką -->
				<div class="mobile-icons">
					<!-- Ikona Ulubionych -->
					<div class="mobile-icon mobile-icon--wishlist">
						<a href="/ulubione" class="wishlist-link">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/serduszko.svg'); ?>" alt="" aria-hidden="true">
							<span class="screen-reader-text"><?php echo esc_html__( 'Ulubione', 'pen-pol' ); ?></span>
						</a>
					</div>

					<!-- Ikona Konta -->
					<div class="mobile-icon mobile-icon--account">
						<a href="/moje-konto" class="account-link">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/user.svg'); ?>" alt="" aria-hidden="true">
							<span class="screen-reader-text"><?php echo esc_html__( 'Konto', 'pen-pol' ); ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content"><?php // Start site content ?>