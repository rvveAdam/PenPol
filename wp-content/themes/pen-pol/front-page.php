<?php
/**
 * 
 * Template for displaying the front page
 *
 * @package Pen-pol
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php get_template_part('template-parts/home/hero'); ?>
    <?php get_template_part('template-parts/home/categories'); ?>
    <?php get_template_part('template-parts/home/poradniki'); ?>
    <?php get_template_part('template-parts/home/produkty-home'); ?>
    <?php get_template_part('template-parts/home/o-nas'); ?>
    <?php get_template_part('template-parts/global/faq'); ?>
    <?php get_template_part('template-parts/global/opinions'); ?>
    <?php get_template_part('template-parts/home/blog'); ?>
    <div class="swiper-pagination"></div>

</main><!-- #main -->

<?php
get_footer();