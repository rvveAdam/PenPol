<?php
/**
 * Pen-pol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pen-pol
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pen_pol_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Pen-pol, use a find and replace
		* to change 'pen-pol' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'pen-pol', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'pen-pol' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'pen_pol_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'pen_pol_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pen_pol_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pen_pol_content_width', 640 );
}
add_action( 'after_setup_theme', 'pen_pol_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pen_pol_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pen-pol' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pen-pol' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pen_pol_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pen_pol_scripts() {
	// Domyślny style.css WordPress
	wp_enqueue_style( 'pen-pol-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pen-pol-style', 'rtl', 'replace' );

	// Nasz główny plik stylów SCSS
	wp_enqueue_style(
		'pen-pol-main-style', 
		get_template_directory_uri() . '/assets/scss/main.css', 
		array(), 
		_S_VERSION
	);

	// Swiper CSS
	wp_enqueue_style(
		'swiper-css', 
		'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
		array(),
		'8.0.0'
	);

	// Navigation JS
	wp_enqueue_script( 
		'pen-pol-navigation', 
		get_template_directory_uri() . '/js/navigation.js', 
		array(), 
		_S_VERSION, 
		true 
	);

	// Swiper JS
	wp_enqueue_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
		array(),
		'8.0.0',
		true
	);

	// Hero swiper JS
	wp_enqueue_script(
		'hero-swiper-js',
		get_template_directory_uri() . '/assets/dist/hero-swiper.js',
		array('swiper-js'),
		_S_VERSION,
		true
	);

	wp_enqueue_style(
    'pen-pol-fonts', 
    get_template_directory_uri() . '/assets/dist/fonts.css', 
    array(), 
    _S_VERSION
	);

	// Comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Accordion Poradniki JS
	wp_enqueue_script(
		'accordion-poradniki-js',
		get_template_directory_uri() . '/assets/dist/accordion-poradniki.js',
		array('swiper-js'),
		_S_VERSION,
		true
	);

	// FAQ JS
	wp_enqueue_script(
		'faq-js',
		get_template_directory_uri() . '/assets/dist/faq.js',
		array(), // Nie wymaga Swipera, jest niezależny
		_S_VERSION,
		true
	);
}
	add_action( 'wp_enqueue_scripts', 'pen_pol_scripts' );

	/**
	 * Carousel Opinie JS
	 */
	function pen_pol_opinions_scripts() {
		// Sprawdź czy jesteśmy na stronie głównej LUB na stronie O nas
		if (is_front_page() || is_page('o-nas') || is_single()) {
			wp_enqueue_script(
				'home-carousel',
				get_template_directory_uri() . '/assets/dist/home-carousel.js',
				array('swiper-js'),
				_S_VERSION,
				true
			);
		}
	}
	add_action('wp_enqueue_scripts', 'pen_pol_opinions_scripts');

	/**
	 * Header
	 */
	function pen_pol_header_scripts() {
		wp_enqueue_script(
			'pen-pol-header-scripts',
			get_template_directory_uri() . '/assets/dist/header.js',
			array(),
			_S_VERSION,
			true
		);
	}
	add_action('wp_enqueue_scripts', 'pen_pol_header_scripts');

	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/custom-header.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */
	require get_template_directory() . '/inc/template-functions.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';



	/**
	 * Load Jetpack compatibility file.
	 */
	if ( defined( 'JETPACK__VERSION' ) ) {
		require get_template_directory() . '/inc/jetpack.php';
	}

// Woocommerce
add_theme_support('woocommerce');
// Remove WooCommerce Styles
function remove_woocommerce_styles($enqueue_styles) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles',  'remove_woocommerce_styles');
// Woocommerce style
function wp_enqueue_woocommerce_style(){
    wp_register_style( 'pen-pol', get_template_directory_uri() . '/assets/scss/woocommerce/woocommerce.css' );
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style( 'pen-pol' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );

/**
 * Ograniczenie liczby wpisów na stronach archiwum do 5
 *
 * @param WP_Query $query Obiekt zapytania.
 */
function pen_pol_archive_posts_per_page($query) {
    // Tylko na front-endzie i tylko dla głównego zapytania
    if (!is_admin() && $query->is_main_query()) {
        // Dla archiwów, kategorii, tagów i strony głównej bloga
        if ($query->is_archive() || $query->is_home()) {
            $query->set('posts_per_page', 5);
        }
    }
}
add_action('pre_get_posts', 'pen_pol_archive_posts_per_page');

/**
 * Dodaj obsługę ulubionych produktów
 */
function pen_pol_favorites_scripts() {
    // Sprawdź czy WooCommerce jest aktywny
    if (!class_exists('WooCommerce')) {
        return;
    }
    
    // Zarejestruj i załaduj skrypt ulubionych
    wp_enqueue_script(
        'pen-pol-favorites',
        get_template_directory_uri() . '/assets/dist/favourites.js', 
        array('jquery'),
        _S_VERSION,
        true
    );
    
    // Lokalizacja skryptu dla tłumaczeń i ustawień
    wp_localize_script(
        'pen-pol-favorites',
        'pen_pol_favorites',
        array(
            'confirm_clear' => __('Czy na pewno chcesz usunąć wszystkie ulubione produkty?', 'pen-pol'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('pen_pol_favorites_nonce'),
        )
    );
}
add_action('wp_enqueue_scripts', 'pen_pol_favorites_scripts');

/**
 * Dodaj atrybuty data-product-id do kart produktów w WooCommerce
 */
function pen_pol_add_product_id_to_cards($html, $data, $product) {
    // Dodaj atrybut data-product-id do każdej karty produktu
    $html = preg_replace(
        '/class="content-product"/',
        'data-product-id="' . esc_attr($product->get_id()) . '" class="content-product',
        $html
    );
    
    return $html;
}
add_filter('woocommerce_template_loop_product_link_open', 'pen_pol_add_product_id_to_cards', 10, 3);

/**
 * Enqueue Single Product JS
 */
function pen_pol_single_product_scripts() {
    if (is_product()) {
        wp_enqueue_script(
            'pen-pol-single-product',
            get_template_directory_uri() . '/assets/dist/single-product.js',
            array('jquery', 'swiper-js'),
            _S_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'pen_pol_single_product_scripts');

/**
 * AJAX dodawanie do koszyka
 */
function pen_pol_ajax_add_to_cart() {
    ob_start();
    
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        
        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
        
        wp_send_json($data);
    }
    
    wp_die();
}
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'pen_pol_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'pen_pol_ajax_add_to_cart');

/**
 * Usuń domyślne breadcrumbsy i nagłówek "Related products"
 */
function pen_pol_remove_woocommerce_elements() {
    // Usuń breadcrumbsy z hooka woocommerce_before_main_content
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    
    // Usuń related products
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('init', 'pen_pol_remove_woocommerce_elements');



/**
 * Product badge system for Pen-pol theme with shortcodes
 * 
 * Provides two shortcodes:
 * - [product_badge_card] - For product cards with absolute positioning
 * - [product_badge_inline] - For single product page with inline display
 *
 * @package Pen-pol
 */

/**
 * Get product badge data based on product properties with proper priority
 *
 * Priority:
 * 1. "Promocja 50%" (dla promocji 50% i więcej) - najwyższy priorytet (3)
 * 2. "Najlepsza Cena" (dla promocji poniżej 50%) - średni priorytet (2)
 * 3. "Nowość" (dla produktów dodanych w ciągu ostatnich 7 dni) - najniższy priorytet (1)
 *
 * @param WC_Product $product Product object
 * @return array|false Badge data array or false if no badge
 */
function pen_pol_get_product_badge($product) {
    if (!$product || !is_a($product, 'WC_Product')) {
        return false;
    }
    
    // Inicjalizacja zmiennej z priorytetem
    // Wyższy numer = wyższy priorytet
    $badge_priority = 0;
    $badge_type = '';
    $badge_text = '';
    
    // Sprawdzenie promocji
    if ($product->is_on_sale()) {
        $regular_price = (float)$product->get_regular_price();
        $sale_price = (float)$product->get_sale_price();
        
        if ($regular_price > 0) {
            $percentage = round(100 - ($sale_price / $regular_price * 100));
            
            // Promocja 50% (i więcej) - NAJWYŻSZY priorytet (3)
            if ($percentage >= 50) {
                if (3 > $badge_priority) {
                    $badge_priority = 3;
                    $badge_type = 'promotion';
                    $badge_text = __('Promocja 50%', 'pen-pol');
                }
            } 
            // Najlepsza Cena (promocje poniżej 50%) - ŚREDNI priorytet (2)
            elseif ($percentage > 0) {
                if (2 > $badge_priority) {
                    $badge_priority = 2;
                    $badge_type = 'best-price';
                    $badge_text = __('Najlepsza Cena', 'pen-pol');
                }
            }
        }
    }
    
    // Sprawdzenie czy produkt jest nowy - NAJNIŻSZY priorytet (1)
    $post_date = get_the_date('Y-m-d', $product->get_id());
    $date_diff = (time() - strtotime($post_date)) / DAY_IN_SECONDS;
    
    if ($date_diff <= 7) {
        if (1 > $badge_priority) {
            $badge_priority = 1;
            $badge_type = 'new';
            $badge_text = __('Nowość', 'pen-pol');
        }
    }
    
    if (empty($badge_type) || empty($badge_text)) {
        return false;
    }
    
    return [
        'type' => $badge_type,
        'text' => $badge_text
    ];
}

/**
 * Shortcode dla wyświetlania badgea na kartach produktów (pozycja absolutna)
 *
 * @param array $atts Atrybuty shortcode'a
 * @return string HTML output
 */
function pen_pol_product_badge_card_shortcode($atts) {
    global $product;
    
    // Parsowanie atrybutów
    $atts = shortcode_atts(array(
        'product_id' => 0,
    ), $atts, 'product_badge_card');
    
    // Ustalenie produktu
    $current_product = $product;
    if (!empty($atts['product_id'])) {
        $current_product = wc_get_product($atts['product_id']);
    }
    
    if (!$current_product) {
        return '';
    }
    
    // Pobierz dane badgea
    $badge = pen_pol_get_product_badge($current_product);
    if (!$badge) {
        return '';
    }
    
    // Zwróć HTML
    return '<div class="product-card__tag product-card__tag--' . esc_attr($badge['type']) . '">' . 
           esc_html($badge['text']) . 
           '</div>';
}
add_shortcode('product_badge_card', 'pen_pol_product_badge_card_shortcode');

/**
 * Shortcode dla wyświetlania badgea na stronie produktu (inline)
 *
 * @param array $atts Atrybuty shortcode'a
 * @return string HTML output
 */
function pen_pol_product_badge_inline_shortcode($atts) {
    global $product;
    
    // Parsowanie atrybutów
    $atts = shortcode_atts(array(
        'product_id' => 0,
    ), $atts, 'product_badge_inline');
    
    // Ustalenie produktu
    $current_product = $product;
    if (!empty($atts['product_id'])) {
        $current_product = wc_get_product($atts['product_id']);
    }
    
    if (!$current_product) {
        return '';
    }
    
    // Pobierz dane badgea
    $badge = pen_pol_get_product_badge($current_product);
    if (!$badge) {
        return '';
    }
    
    // Zwróć HTML z klasą badge-TYPE dla odpowiedniego koloru
    return '<span class="badge badge-sale badge-' . esc_attr($badge['type']) . '">' . 
           esc_html($badge['text']) . 
           '</span>';
}
add_shortcode('product_badge_inline', 'pen_pol_product_badge_inline_shortcode');

/**
 * Dodaj badge do galerii na stronie pojedynczego produktu
 */
function pen_pol_add_badge_to_product_gallery() {
    echo do_shortcode('[product_badge_card]');
}
add_action('woocommerce_before_single_product_summary', 'pen_pol_add_badge_to_product_gallery', 15);

/**
 * Enqueue styles for WooCommerce My Account page
 */
function pen_pol_my_account_styles() {
    // Sprawdź czy WooCommerce jest aktywny
    if (class_exists('WooCommerce')) {
        // Sprawdź czy jesteśmy na stronie mojego konta
        if (is_account_page()) {
            // Załaduj Dashicons (ikonki WordPress)
            wp_enqueue_style('dashicons');
            
            // Załaduj style dla mojego konta
            wp_enqueue_style(
                'pen-pol-my-account',
                get_template_directory_uri() . '/assets/dist/my-account.css',
                array(), // Brak zależności
                _S_VERSION
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'pen_pol_my_account_styles', 20);

//checkout js
add_action('wp_enqueue_scripts', function() {
	if (is_checkout()) {
		wp_enqueue_script(
			'custom-checkout-notices',
			get_stylesheet_directory_uri() . '/assets/dist/checkout-notices.js',
			['jquery', 'wc-checkout'],
			'1.0',
			true
		);
	}
});

function pen_pol_thankyou_page_styles() {
    // Check if WooCommerce is active and we're on the thank you page
    if (class_exists('WooCommerce') && is_order_received_page()) {
        wp_enqueue_style(
            'pen-pol-thankyou-page',
            get_template_directory_uri() . '/assets/dist/thankyoupage.css',
            array(),
            _S_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'pen_pol_thankyou_page_styles');

//usun metody platnosci z order review
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

//odswiezenie AJAX metod wysylki w checkoucie
add_filter('woocommerce_update_order_review_fragments', 'filter_update_order_review_fragments');
function filter_update_order_review_fragments($fragments)
{
	ob_start();
	if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
		<div class="checkout__shipping-refresh">
			<?php do_action('woocommerce_review_order_before_shipping'); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action('woocommerce_review_order_after_shipping'); ?>
		</div>
	<?php endif;

	$fragments['.checkout__shipping-refresh'] = ob_get_clean();

	return $fragments;
}


//test logo checkout metoda wysylki
add_filter('woocommerce_cart_shipping_method_full_label', function ($label, $method) {
	if (strpos($method->id, 'flat_rate:3') !== false) {
		$label .= ' <img src="wp-content/uploads/2025/07/logo-czarne.png" alt="Logo" style="height: 20px; margin-left: 8px;" />';
	}
	return $label;
}, 10, 2);


/**
 * WooCommerce AJAX cart functionality
 * Tylko aktualizacja licznika produktów
 *
 * @package Pen-pol
 */

if ( ! function_exists( 'pen_pol_woocommerce_cart_link_fragment' ) ) {
	function pen_pol_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		pen_pol_woocommerce_cart_link();
		$fragments['a.cart-link'] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pen_pol_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'pen_pol_woocommerce_cart_link' ) ) {
	function pen_pol_woocommerce_cart_link() {
		?>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-link" aria-label="<?php esc_attr_e( 'Zobacz koszyk', 'pen-pol' ); ?>">
			<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/koszyk.svg'); ?>" alt="" aria-hidden="true">
			<span class="screen-reader-text"><?php echo esc_html__( 'Koszyk', 'pen-pol' ); ?></span>
			<span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'pen_pol_woocommerce_header_cart' ) ) {
	function pen_pol_woocommerce_header_cart() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}
		?>
		<div class="header-icon header-icon--cart">
			<?php pen_pol_woocommerce_cart_link(); ?>
		</div>
		<?php
	}
}