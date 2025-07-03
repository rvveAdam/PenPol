<?php
/**
 * Template part for displaying Hero section
 *
 * @package Pen-pol
 */

// Pobierz dane z ACF
$hero_group = get_field('sg-hero');
$hero_slides = $hero_group['sg-hero_slajder'] ?? [];

// Sprawdź czy są slajdy
if (empty($hero_slides)) {
    return;
}

// Sprawdź czy to pojedynczy slajd
$is_single_slide = count($hero_slides) === 1;
$hero_class = $is_single_slide ? 'hero-swiper--single' : '';
?>

<section class="hero-section" aria-label="Hero banner">
    <div class="hero-swiper <?php echo $hero_class; ?>">
        <div class="swiper-wrapper">
            <?php foreach ($hero_slides as $index => $slide): ?>
                <?php
                // Pobierz ID obrazka i przekonwertuj na URL i alt
                $image_id = $slide['sg-hero_slajder_obrazek'] ?? null;
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
                $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
                
                $title_main = $slide['sg-hero_slajder_naglowek-main'] ?? '';
                $title_accent = $slide['sg-hero_slajder_naglowek-akcent'] ?? '';
                $text = $slide['sg-hero_slajder_tekst'] ?? '';
                $button_url = $slide['sg-hero_slajder_button_url'] ?? '';
                $button_text = $slide['sg-hero_slajder_button_text'] ?? 'Odkryj wszystkie kategorie';
                
                // Fallback dla alt text
                if (!$image_alt && ($title_main || $title_accent)) {
                    $image_alt = trim($title_main . ' ' . $title_accent);
                }
                ?>
                
                <div class="swiper-slide" role="tabpanel" aria-label="Slajd <?php echo $index + 1; ?>">
                    <div class="hero-slide">
                        <div class="hero-slide__background <?php echo !$image_url ? 'hero-slide__background--fallback' : ''; ?>">
                            <?php if ($image_url): ?>
                                <img src="<?php echo esc_url($image_url); ?>" 
                                     alt="<?php echo esc_attr($image_alt ?: 'Hero image'); ?>" 
                                     class="hero-slide__image"
                                     loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                            <?php endif; ?>
                            <div class="hero-slide__overlay" aria-hidden="true"></div>
                        </div>
                        
                        <div class="hero-slide__content">
                            <div class="container">
                                <div class="hero-slide__content-wrapper">
                                    <!-- Top section: Title + Navigation -->
                                    <div class="hero-slide__top-section">
                                        <div class="hero-slide__left-column">
                                            <?php if ($title_main || $title_accent): ?>
                                                <h1 class="hero-slide__title">
                                                    <?php if ($title_main): ?>
                                                        <span class="hero-slide__title-main"><?php echo esc_html($title_main); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($title_accent): ?>
                                                        <span class="hero-slide__title-accent"><?php echo esc_html($title_accent); ?></span>
                                                    <?php endif; ?>
                                                </h1>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php if (!$is_single_slide): ?>
                                            <div class="hero-slide__right-column">
                                                <!-- Navigation będzie tutaj -->
                                                <div class="hero-slide__navigation">
                                                    <button class="hero-swiper-button-prev" 
                                                            aria-label="Poprzedni slajd"
                                                            type="button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </button>
                                                    <button class="hero-swiper-button-next" 
                                                            aria-label="Następny slajd"
                                                            type="button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Bottom section: Text + Button -->
                                    <div class="hero-slide__bottom-section">
                                        <div class="hero-slide__left-column">
                                            <?php if ($text): ?>
                                                <div class="hero-slide__text">
                                                    <p><?php echo esc_html($text); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="hero-slide__right-column">
                                            <?php if ($button_url): ?>
                                                <div class="hero-slide__button">
                                                    <a href="<?php echo esc_url($button_url); ?>" 
                                                       class="btn"
                                                       aria-label="<?php echo esc_attr($button_text); ?>">
                                                        <?php echo esc_html($button_text); ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-arrow.svg" 
                                                             alt="" 
                                                             width="20" 
                                                             height="20">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (!$is_single_slide): ?>
            <!-- Pagination - zostaje poza contentem -->
            <div class="hero-swiper-pagination swiper-pagination" 
                 role="tablist" 
                 aria-label="Wybierz slajd"></div>
        <?php endif; ?>
    </div>
</section>

<?php if (!$is_single_slide): ?>
<script>
// Inline script for hero swiper initialization
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        const heroSwiper = new Swiper('.hero-swiper', {
            // Core settings
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 800,
            
            // Navigation
            navigation: {
                nextEl: '.hero-swiper-button-next',
                prevEl: '.hero-swiper-button-prev',
            },
            
            // Pagination
            pagination: {
                el: '.hero-swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '" aria-label="Idź do slajdu ' + (index + 1) + '" role="tab"></span>';
                },
            },
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Poprzedni slajd',
                nextSlideMessage: 'Następny slajd',
                firstSlideMessage: 'To jest pierwszy slajd',
                lastSlideMessage: 'To jest ostatni slajd',
                paginationBulletMessage: 'Idź do slajdu {{index}}'
            },
            
            // Keyboard control
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Events
            on: {
                init: function () {
                    document.querySelector('.hero-section').classList.add('loaded');
                },
                slideChange: function () {
                    // Reset animations for new slide
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        const elements = activeSlide.querySelectorAll('.hero-slide__title-main, .hero-slide__title-accent, .hero-slide__text, .hero-slide__button');
                        elements.forEach(el => {
                            el.style.animation = 'none';
                            el.offsetHeight; // Trigger reflow
                            el.style.animation = null;
                        });
                    }
                }
            }
        });
        
        // Pause autoplay on focus for accessibility
        const focusableElements = document.querySelectorAll('.hero-slide a, .hero-slide button');
        focusableElements.forEach(el => {
            el.addEventListener('focus', () => heroSwiper.autoplay.stop());
            el.addEventListener('blur', () => heroSwiper.autoplay.start());
        });
    }
});
</script>
<?php endif; ?>