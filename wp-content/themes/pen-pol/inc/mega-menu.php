<?php
/**
 * Custom Nav Walker dla Mega Menu
 *
 * @package Pen-pol
 * @since 1.0.0
 */

/**
 * Custom Nav Walker dla Mega Menu
 */
class Pen_Pol_Mega_Menu_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        // Inicjalizacja elementu
        $menu_item = $data_object;

        $indent = str_repeat("\t", $depth);
        $classes = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;
        
        // Sprawdzanie czy element ma dzieci (podrzędne elementy menu)
        $has_children = $args->walker->has_children;
        
        if ($has_children) {
            $classes[] = 'menu-item-has-children';
        }
        
        // Sprawdź, czy element ma odpowiednią klasę mm-content-depth dla danego poziomu
        $has_mm_content_depth = false;
        if ($depth > 0) {
            $depth_class = 'mm-content-depth' . $depth;
            $has_mm_content_depth = in_array($depth_class, $classes);
        }
        
        // Filtrowanie klas CSS
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        // ID elementu menu
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        // Dodanie atrybutu data-depth
        $data_depth = ' data-depth="' . esc_attr($depth) . '"';
        
        $output .= $indent . '<li' . $id . $class_names . $data_depth . '>';
        
        // Atrybuty elementu
        $atts = array();
        $atts['title']  = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        $atts['rel']    = !empty($menu_item->xfn) ? $menu_item->xfn : '';
        $atts['href']   = !empty($menu_item->url) ? $menu_item->url : '';
        
        // Dodanie atrybutu aria-expanded dla elementów z dziećmi
        if ($has_children) {
            $atts['aria-expanded'] = 'false';
        }
        
        // Filtrowanie atrybutów
        $atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);
        
        // Budowanie atrybutów
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        // Nazwa elementu menu
        $title = apply_filters('the_title', $menu_item->title, $menu_item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);
        
        // Rozpoczęcie tagu a
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . ' class="menu-link">';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // Dodajemy strzałkę tylko dla elementów poziomu 1+ z klasą mm-content-depth
        if ($depth > 0 && $has_mm_content_depth) {
            $item_output .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/chevron-right-black.svg') . '" class="menu-chevron-right" alt="" aria-hidden="true">';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        // Rozpoczęcie mega menu, jeśli element jest na najwyższym poziomie i ma dzieci oraz klasę mm-content
        if ($depth === 0 && $has_children && in_array('mm-content', $classes)) {
            $item_output .= '<div class="mega-menu-wrapper">';
            $item_output .= '<div class="mega-menu-container">';
            
            // Przygotowanie kontenera na zawartość menu
            $item_output .= '<div class="mega-menu-content">';
            
            // Kontener dla pierwszej kolumny submenu
            $item_output .= '<div class="mega-menu-primary">';
            
            // Nagłówek z rozdzielonym stylem Pen-Pol
            $item_output .= '<div class="mega-menu-header"><h2 class="mega-menu-title">' . esc_html($title) . ' - <span class="brand-name">Pen-Pol</span></h2></div>';
        }
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }
    
    /**
     * Ends the element output, if needed.
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $menu_item = $data_object;
        $classes = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        
        // Jeśli element jest na poziomie 0 i ma dzieci oraz klasę mm-content, zamykamy mega-menu
        if ($depth === 0 && in_array('menu-item-has-children', $classes) && in_array('mm-content', $classes)) {
            // Zamknięcie kontenera pierwszej kolumny
            $output .= '</div>'; // Zamknięcie .mega-menu-primary
            
            // Kontenery dla depth2-5 będą dodawane dynamicznie przez JavaScript
            
            // Zamknięcie kontenera na zawartość menu
            $output .= '</div>'; // Zamknięcie .mega-menu-content
            
            $promo_enabled = get_theme_mod('mega_menu_promo_enabled', true);

            if ($promo_enabled) {
                $promo_heading = get_theme_mod('mega_menu_promo_heading', 'Promocja! 15% taniej');
                $promo_text = get_theme_mod('mega_menu_promo_text', '<p>Lekkie kołdry i poduszki</p>');
                $promo_image = get_theme_mod('mega_menu_promo_image', get_template_directory_uri() . '/assets/images/promo-default.jpg');
                
                // Dodanie kafelka promocyjnego
                $output .= '<div class="mega-menu-promo">';
                
                // Treść kafelka
                $output .= '<div class="mega-menu-promo-content">';
                
                if (!empty($promo_heading)) {
                    // Dzielimy tekst na dwie części - "Promocja!" i resztę tekstu
                    $parts = explode(' ', $promo_heading, 2);
                    $first_word = isset($parts[0]) ? $parts[0] : $promo_heading;
                    $rest_text = isset($parts[1]) ? ' ' . $parts[1] : '';
                    
                    // Wyświetlamy pierwszy wyraz (Promocja!) w spanie z klasą, a resztę normalnie
                    $output .= '<h3 class="mega-menu-promo-content-heading">';
                    $output .= '<span class="promo-first-word">' . esc_html($first_word) . '</span>';
                    $output .= esc_html($rest_text);
                    $output .= '</h3>';
                }
                
                if (!empty($promo_text)) {
                    $output .= '<div class="mega-menu-promo-content-text">' . wp_kses_post($promo_text) . '</div>';
                }
                
                $output .= '</div>'; // .mega-menu-promo-content
                
                // Obraz kafelka
                $output .= '<div class="mega-menu-promo-image">';
                if (!empty($promo_image)) {
                    $output .= '<img src="' . esc_url($promo_image) . '" alt="Promocja">';
                }
                $output .= '</div>'; // .mega-menu-promo-image
                
                $output .= '</div>'; // .mega-menu-promo
            }
            
            $output .= '</div>'; // Zamknięcie .mega-menu-container
            $output .= '</div>'; // Zamknięcie .mega-menu-wrapper
        }
        
        $output .= "</li>\n";
    }
    
    /**
     * Starts the level output.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        
        // Dodanie odpowiednich klas dla różnych poziomów menu
        if ($depth === 0) {
            $output .= "$indent<ul class=\"sub-menu level-1\">\n";
        } else {
            $output .= "$indent<ul class=\"sub-menu level-" . ($depth + 1) . "\">\n";
        }
    }
}