<?php
/**
 * Template Part: Blog Posts Section
 * 
 * Displays latest blog posts and newsletter signup
 * Uses ACF fields: sg_wpisy group
 * Location: template-parts/home/blog.php
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

// Pobranie danych ACF
$blog_data = get_field('sg_wpisy');

if (!$blog_data) {
    return;
}

$heading = $blog_data['sg_wpisy-naglowek'] ?? '';
$newsletter_heading = $blog_data['sg_wpisy-naglowek-newsletter'] ?? 'Bądź na bieżąco z miękkimi nowościami';
$newsletter_text = $blog_data['sg_wpisy-tekst-newsletter'] ?? 'Zapisz się na nasz newsletter i jako pierwszy dowiaduj się o nowościach, promocjach i poradach na temat zdrowego snu.';

// Pobierz 3 najnowsze wpisy
$posts_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
);
$recent_posts = new WP_Query($posts_args);
?>

<section class="blog-section" aria-labelledby="blog-heading">
    <div class="container">
        <!-- Top section with heading and CTA -->
        <div class="blog-section__header">
            <div class="blog-section__header-left">
                <?php if (!empty($heading)) : ?>
                <h2 id="blog-heading" class="blog-section__heading">
                    <?php echo wp_kses_post($heading); ?>
                </h2>
                <?php endif; ?>
            </div>
            <div class="blog-section__header-right">
                <div class="blog-section__cta">
                    <a href="/blog" 
                       class="btn btn--link btn--link--dark"
                       aria-describedby="blog-heading">
                        <span class="btn__text"><?php esc_html_e('Czytaj więcej', 'pen-pol'); ?></span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow_top-right--black.svg'); ?>" class="btn__icon btn__icon--right" alt="" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>

        <!-- Posts grid with swiper for mobile -->
        <div class="blog-section__posts">
            <!-- Slider container for mobile -->
            <div class="blog-section__swiper swiper">
                <div class="swiper-wrapper">
                    <?php 
                    // Loop for posts
                    if ($recent_posts->have_posts()) :
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
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
                                    <?php echo wp_kses_post($newsletter_heading); ?>
                                </h3>
                                
                                <div class="post-card__excerpt post-card__excerpt--newsletter">
                                    <?php echo wp_kses_post($newsletter_text); ?>
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