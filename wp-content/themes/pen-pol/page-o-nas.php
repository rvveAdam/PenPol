<?php
/**
 * Template Name: O nas
 *
 * @package Pen-pol
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php 
    get_template_part('template-parts/o-nas/hero');
    get_template_part('template-parts/o-nas/historia-firmy');
    get_template_part('template-parts/o-nas/dlaczego-my');
    get_template_part('template-parts/o-nas/zespol');
    get_template_part('template-parts/global/opinions');


    // Tutaj będą kolejne sekcje podstrony
    ?>
</main>

<?php
get_footer();