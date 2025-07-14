<?php
/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pen-pol
 */

get_header();

// Get previous and next post
$prev_post = get_previous_post();
$next_post = get_next_post();

// Get the featured image
$post_thumbnail_id = get_post_thumbnail_id();
$post_thumbnail_url = wp_get_attachment_image_url($post_thumbnail_id, 'full');
$post_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);

// Fallback for alt text
if (empty($post_thumbnail_alt)) {
    $post_thumbnail_alt = sprintf(__('Zdjęcie: %s', 'pen-pol'), get_the_title());
}

// Newsletter content
$newsletter_heading = __('Bądź na bieżąco z miękkimi nowościami', 'pen-pol');
$newsletter_text = __('Zapisz się na nasz newsletter i jako pierwszy dowiaduj się o nowościach, promocjach i poradach na temat zdrowego snu.', 'pen-pol');

// Related posts - same category, excluding current
$current_post_id = get_the_ID();
$categories = get_the_category();
$category_ids = array();

foreach ($categories as $category) {
    $category_ids[] = $category->term_id;
}

$related_posts_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'post__not_in' => array($current_post_id),
    'category__in' => $category_ids,
    'orderby' => 'rand',
);

$related_posts = new WP_Query($related_posts_args);

// If no related posts found, get latest posts
if (!$related_posts->have_posts()) {
    $related_posts_args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'post__not_in' => array($current_post_id),
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $related_posts = new WP_Query($related_posts_args);
}
?>

<main id="main-content" class="site-main single-post">
    <?php while (have_posts()) : the_post(); ?>
    
    <!-- Hero Section -->
    <section class="single-post__hero-wrapper">
        <div class="single-post__hero-container">
            <div class="single-post__hero">
                <div class="single-post__background">
                    <?php if ($post_thumbnail_url) : ?>
                        <img src="<?php echo esc_url($post_thumbnail_url); ?>" 
                             alt="<?php echo esc_attr($post_thumbnail_alt); ?>" 
                             class="single-post__image"
                             loading="eager"
                             width="1920" 
                             height="1080">
                    <?php endif; ?>
                    
                    <div class="single-post__overlay" aria-hidden="true"></div>
                </div>
                
                <div class="single-post__content-wrapper">
                    <div class="container">
                        <!-- Breadcrumbs -->
                        <div class="single-post__breadcrumbs">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php esc_html_e('Strona Główna', 'pen-pol'); ?>
                            </a>
                            <span class="separator">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-white.svg'); ?>" alt="" aria-hidden="true">
                            </span>
                            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                                <?php esc_html_e('Blog', 'pen-pol'); ?>
                            </a>
                            <span class="separator">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-white.svg'); ?>" alt="" aria-hidden="true">
                            </span>
                            <span><?php the_title(); ?></span>
                        </div>
                        
                        <!-- Header -->
                        <div class="single-post__header">
                            <h1 class="single-post__title"><?php the_title(); ?></h1>
                        </div>
                        
                        <!-- Excerpt - przeniesiony pod border-bottom -->
                        <div class="single-post__excerpt-wrapper">
                            <div class="single-post__excerpt">
                                <?php if (has_excerpt()) : ?>
                                    <?php the_excerpt(); ?>
                                <?php else : ?>
                                    <?php
                                        // Get the first paragraph if no excerpt
                                        $content = get_the_content();
                                        $content = strip_shortcodes($content);
                                        $content = wp_strip_all_tags($content);
                                        $excerpt = wp_trim_words($content, 30, '...');
                                        echo wp_kses_post($excerpt);
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Content Section -->
    <section class="single-post__main">
        <div class="single-post__container container">
            <!-- Main Content Column -->
            <div class="single-post__content">
                <?php the_content(); ?>
                
                <!-- Post Navigation -->
                <div class="single-post__navigation">
                    <?php if (!empty($prev_post)) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="single-post__navigation-btn single-post__navigation-btn--prev">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-left-black2.svg'); ?>" alt="" aria-hidden="true">
                            <span><?php esc_html_e('Poprzedni wpis', 'pen-pol'); ?></span>
                        </a>
                    <?php else: ?>
                        <span></span> <!-- Empty placeholder to maintain layout -->
                    <?php endif; ?>
                    
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--link btn--link--dark">
                        <span class="btn__text"><?php esc_html_e('Wszystkie wpisy', 'pen-pol'); ?></span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                    </a>
                    
                    <?php if (!empty($next_post)) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="single-post__navigation-btn single-post__navigation-btn--next">
                            <span><?php esc_html_e('Następny wpis', 'pen-pol'); ?></span>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg'); ?>" alt="" aria-hidden="true">
                        </a>
                    <?php else: ?>
                        <span></span> <!-- Empty placeholder to maintain layout -->
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sidebar Column -->
            <div class="single-post__sidebar">
                <div class="single-post__sidebar-inner">
                    <!-- Newsletter Card -->
                    <div class="single-post__newsletter">
                        <h3 class="single-post__newsletter-title">
                            <?php echo esc_html($newsletter_heading); ?>
                        </h3>
                        
                        <div class="single-post__newsletter-text">
                            <?php echo esc_html($newsletter_text); ?>
                        </div>
                        
                        <div class="single-post__newsletter-form">
                            <?php echo do_shortcode('[wpforms id="309"]'); ?>
                        </div>
                    </div>
                    
                    <!-- Products Section -->
                    <div class="single-post__products">
                        <h3 class="single-post__products-title">
                            <?php esc_html_e('Nowości!', 'pen-pol'); ?>
                        </h3>
                        
                        <!-- Product cards will be added in future implementation -->
                        <div class="single-post__products-placeholder">
                            <!-- Placeholder for future product cards -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php endwhile; ?>
    
    <!-- Related Posts Section -->
    <section class="single-post__related">
        <div class="single-post__related-container">
            <!-- Header -->
            <div class="single-post__related-header">
                <h2 class="single-post__related-title">
                    <span class="single-post__related-title-accent">Zobacz</span> 
                    <span class="single-post__related-title-main">inne wpisy</span>
                </h2>
                
                <div class="single-post__related-cta">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--link btn--link--dark">
                        <span class="btn__text"><?php esc_html_e('Czytaj więcej', 'pen-pol'); ?></span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                    </a>
                </div>
            </div>
            
            <!-- Posts Grid -->
            <div class="blog-section__posts">
                <div class="blog-section__swiper swiper">
                    <div class="swiper-wrapper">
                        <?php 
                        // Loop for posts
                        if ($related_posts->have_posts()) :
                            while ($related_posts->have_posts()) : $related_posts->the_post();
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
                                $post_categories = get_the_category();
                        ?>
                        
                        <div class="swiper-slide">
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
                                    
                                    <?php if (!empty($post_categories)) : ?>
                                    <div class="post-card__meta">
                                        <div class="post-card__categories">
                                            <?php foreach ($post_categories as $category) : ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="post-card__category">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                        
                        <!-- Newsletter Card -->
                        <div class="swiper-slide">
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
                        </div>
                    </div>
                    
                    <!-- Pagination dla mobilnej wersji -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();