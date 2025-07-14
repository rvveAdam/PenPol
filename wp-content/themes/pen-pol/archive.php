<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pen-pol
 */

// Security check
if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Format post count text
$post_count = $wp_query->found_posts;
$post_count_text = sprintf(
    _n('%s wpis', '%s wpisów', $post_count, 'pen-pol'),
    number_format_i18n($post_count)
);

// Generate unique section ID for accessibility
$poradniki_id = 'poradniki-section-' . wp_unique_id();
?>

<main id="primary" class="poradniki-page">
    
    <!-- Poradniki Hero Section -->
    <section class="poradniki-hero" aria-labelledby="poradniki-hero-title">
        <div class="poradniki-hero__container">
            <div class="poradniki-hero__content">
                <div class="container">
                    <div class="poradniki-hero__wrapper">
                        <header class="poradniki-hero__header">
                            <div class="poradniki-hero__text-content">
                                <h1 id="poradniki-hero-title" class="poradniki-hero__title">
                                    <?php if (is_home()): ?>
                                        <span class="poradniki-hero__title-main">Jak spać lepiej?</span>
                                        <span class="poradniki-hero__title-accent">Poradnik Pen-Pol</span>
                                    <?php elseif (is_category()): ?>
                                        <?php 
                                        $category = get_queried_object();
                                        echo '<span class="poradniki-hero__title-main">' . esc_html($category->name) . '</span>';
                                        echo '<span class="poradniki-hero__title-accent">Poradnik Pen-Pol</span>';
                                        ?>
                                    <?php elseif (is_tag()): ?>
                                        <?php 
                                        $tag = get_queried_object();
                                        echo '<span class="poradniki-hero__title-main">' . esc_html($tag->name) . '</span>';
                                        echo '<span class="poradniki-hero__title-accent">Poradnik Pen-Pol</span>';
                                        ?>
                                    <?php else: ?>
                                        <span class="poradniki-hero__title-main"><?php the_archive_title(); ?></span>
                                        <span class="poradniki-hero__title-accent">Poradnik Pen-Pol</span>
                                    <?php endif; ?>
                                </h1>

                                <div class="poradniki-hero__description">
                                    <?php if (is_home() && function_exists('get_field')): ?>
                                        <?php 
                                        // Pobieranie opisu bloga z ACF
                                        $blog_description = get_field('blog_archiwum_krotki_opis', 'option');
                                        
                                        if ($blog_description) {
                                            echo wp_kses_post($blog_description);
                                        }
                                        ?>
                                    <?php elseif (is_category()): ?>
                                        <?php
                                        $category = get_queried_object();
                                        echo wp_kses_post(category_description());
                                        ?>
                                    <?php elseif (is_tag()): ?>
                                        <?php 
                                        $tag = get_queried_object();
                                        if ($tag->description) {
                                            echo wp_kses_post($tag->description);
                                        }
                                        ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </header>
                    </div>
                </div>
            </div>
            
            <div class="poradniki-hero__background">
                <?php 
                $featured_image = '';
                
                if (is_home()) {
                    // Dla strony głównej bloga używamy obrazka z ustawień
                    $page_for_posts = get_option('page_for_posts');
                    if (has_post_thumbnail($page_for_posts)) {
                        $featured_image = get_the_post_thumbnail_url($page_for_posts, 'full');
                    }
                } elseif (is_category() && function_exists('get_field')) {
                    // Dla kategorii sprawdzamy, czy jest obrazek w ACF
                    $term = get_queried_object();
                    $image = get_field('thumbnail', $term);
                    if ($image) {
                        $featured_image = $image['url'];
                    }
                }
                
                // Domyślny obrazek, jeśli nie znaleziono żadnego
                if (empty($featured_image)) {
                    $featured_image = get_template_directory_uri() . '/assets/images/archive-default.jpg';
                }
                ?>
                <img src="<?php echo esc_url($featured_image); ?>" 
                     alt="<?php echo is_home() ? esc_attr(get_bloginfo('name')) : esc_attr(get_the_archive_title()); ?>" 
                     class="poradniki-hero__image"
                     loading="eager"
                     decoding="async"
                     fetchpriority="high">
                <div class="poradniki-hero__overlay" aria-hidden="true"></div>
            </div>
        </div>
    </section>
    
    <!-- Poradniki Content Section -->
    <section class="poradniki-content" id="<?php echo esc_attr($poradniki_id); ?>" aria-label="<?php esc_attr_e('Zawartość poradników', 'pen-pol'); ?>">
        <div class="container">
            <div class="poradniki-content__wrapper">
                
                <!-- Sidebar with Filters -->
                <aside class="poradniki-sidebar">
                    <div class="poradniki-sidebar__inner">
                        <h2 class="poradniki-sidebar__title">
                            <?php esc_html_e('Wybierz kategorię:', 'pen-pol'); ?>
                        </h2>
                        
                        <div class="poradniki-sidebar__facets">
                            <?php echo do_shortcode('[facetwp facet="checkbox_wpisy"]'); ?>
                        </div>
                    </div>
                </aside>
                
                <!-- Main Content Area -->
                <div class="poradniki-main">
                    
                    <!-- Header with Result Count -->
                    <header class="poradniki-header">
                        <div class="poradniki-header__results">
                            <span class="poradniki-header__count">
                                <?php echo esc_html($post_count_text); ?>
                            </span>
                        </div>
                    </header>
                    
                    <!-- Posts Grid -->
                    <div class="poradniki-grid facetwp-template">
                        <?php
                        $post_index = 0;
                        
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                $post_index++;
                                
                                // Insert newsletter card at position 3
                                if ($post_index === 3) :
                                    // Newsletter card
                                    $newsletter_heading = 'Bądź na bieżąco z miękkimi nowościami';
                                    $newsletter_text = 'Zapisz się na nasz newsletter i jako pierwszy dowiaduj się o nowościach, promocjach i poradach na temat zdrowego snu.';
                                    ?>
                                    <div class="post-card post-card--newsletter">
                                        <div class="post-card__content post-card__content--newsletter">
                                            <h3 class="post-card__title post-card__title--newsletter">
                                                <?php echo esc_html($newsletter_heading); ?>
                                            </h3>
                                            
                                            <div class="post-card__excerpt post-card__excerpt--newsletter">
                                                <?php echo esc_html($newsletter_text); ?>
                                            </div>
                                            
                                            <div class="post-card__form">
                                                <?php echo do_shortcode('[wpforms id="309"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endif;
                                
                                // Determine post tag (popular or recent)
                                $post_tag = '';
                                $post_tag_class = '';
                                
                                if (has_tag('popular') || has_tag('popularny')) {
                                    $post_tag = __('Popularny', 'pen-pol');
                                    $post_tag_class = 'post-card__tag--popular';
                                } else {
                                    $post_tag = __('Ostatnio dodany', 'pen-pol');
                                    $post_tag_class = 'post-card__tag--recent';
                                }
                                
                                // Create excerpt with 20 words
                                $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
                                
                                // Get all categories
                                $categories = get_the_category();
                                ?>
                                
                                <div class="post-card">
                                    <div class="post-card__image-container">
                                        <span class="post-card__tag <?php echo esc_attr($post_tag_class); ?>">
                                            <?php echo esc_html($post_tag); ?>
                                        </span>
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-card__image-wrapper">
                                            <?php the_post_thumbnail('medium_large', array(
                                                'class' => 'post-card__image',
                                                'alt' => get_the_title(),
                                                'loading' => 'lazy',
                                                'decoding' => 'async'
                                            )); ?>
                                        </div>
                                        <?php else : ?>
                                        <div class="post-card__image-wrapper post-card__image-wrapper--placeholder">
                                            <div class="post-card__image-placeholder"></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="post-card__content">
                                        <h3 class="post-card__title">
                                            <a href="<?php the_permalink(); ?>" class="post-card__link">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        
                                        <?php if (!empty($excerpt)) : ?>
                                        <div class="post-card__excerpt">
                                            <?php echo wp_kses_post($excerpt); ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($categories)) : ?>
                                        <div class="post-card__meta">
                                            <div class="post-card__categories">
                                                <?php foreach ($categories as $category) : ?>
                                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="post-card__category">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            <?php
                            endwhile;
                        else :
                        ?>
                            <div class="poradniki-empty">
                                <p class="poradniki-empty__message">
                                    <?php esc_html_e('Brak wpisów spełniających kryteria.', 'pen-pol'); ?>
                                </p>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="poradniki-pagination">
                        <?php
                        // Standardowa paginacja WordPress
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/arrow-left.svg" alt="' . esc_attr__('Poprzednia strona', 'pen-pol') . '">',
                            'next_text' => '<img src="' . esc_url(get_template_directory_uri()) . '/assets/images/arrow-right.svg" alt="' . esc_attr__('Następna strona', 'pen-pol') . '">',
                            'screen_reader_text' => __('Nawigacja po wpisach', 'pen-pol'),
                        ));
                        ?>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
    
</main><!-- #primary -->

<?php
get_footer();