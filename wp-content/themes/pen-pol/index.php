<?php
get_header();

if ( is_home() ) {
    include get_template_directory() . '/archive.php';
} else {
    echo 'fallback index';
}

get_footer();