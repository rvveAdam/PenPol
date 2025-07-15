<?php
/**
 * Template Name: Standardowy Szablon
 *
 * Szablon uniwersalny dla stron takich jak koszyk, moje konto itp.
 *
 * @package Pen-pol
 */

get_header();
?>

<main id="primary" class="standard-template">
    <div class="standard-template__container">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();