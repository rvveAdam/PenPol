/**
 * Hero section slider initialization
 * 
 * Uses Swiper.js library
 * @link https://swiperjs.com/
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        // Check if swiper container exists
        const heroSwiperContainer = document.querySelector('.hero-swiper');
        if (!heroSwiperContainer) return;
        
        // Check if we have multiple slides
        const slides = heroSwiperContainer.querySelectorAll('.swiper-slide');
        const hasMultipleSlides = slides.length > 1;
        
        // If only one slide, don't initialize swiper
        if (!hasMultipleSlides) {
            // Just show the single slide
            const singleSlide = slides[0];
            if (singleSlide) {
                singleSlide.classList.add('swiper-slide-active');
                
                // Trigger animations for single slide
                setTimeout(() => {
                    const title = singleSlide.querySelector('.hero-slide__title');
                    const text = singleSlide.querySelector('.hero-slide__text');
                    const button = singleSlide.querySelector('.hero-slide__button');
                    
                    if (title) title.style.animation = 'slideInUp 0.8s ease-out 0.2s both';
                    if (text) text.style.animation = 'slideInUp 0.8s ease-out 0.4s both';
                    if (button) button.style.animation = 'slideInUp 0.8s ease-out 0.6s both';
                }, 100);
            }
            return;
        }
        
        // Remove no-js class from body
        document.body.classList.remove('no-js');
        
        // Add loading class
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.classList.add('loading');
        }
        
        // Initialize Swiper
        const heroSwiper = new Swiper('.hero-swiper', {
            // Basic parameters
            speed: 800,
            loop: true,
            loopAdditionalSlides: 1,
            
            // Effect configuration
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            
            // Autoplay configuration
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
                waitForTransition: false
            },
            
            // Navigation arrows
            navigation: {
                nextEl: '.hero-swiper-button-next',
                prevEl: '.hero-swiper-button-prev',
                disabledClass: 'swiper-button-disabled'
            },
            
            // Pagination
            pagination: {
                el: '.hero-swiper-pagination',
                clickable: true,
                dynamicBullets: false,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '" aria-label="Przejdź do slajdu ' + (index + 1) + '"></span>';
                }
            },
            
            // Lazy loading
            lazy: {
                loadPrevNext: true,
                loadPrevNextAmount: 1
            },
            
            // Preload images
            preloadImages: false,
            updateOnImagesReady: true,
            
            // Accessibility
            a11y: {
                enabled: true,
                prevSlideMessage: 'Poprzedni slajd',
                nextSlideMessage: 'Następny slajd',
                firstSlideMessage: 'To jest pierwszy slajd',
                lastSlideMessage: 'To jest ostatni slajd',
                paginationBulletMessage: 'Przejdź do slajdu {{index}}',
                slideRole: 'group',
                slideLabelMessage: 'Slajd {{index}} z {{slidesLength}}'
            },
            
            // Performance optimization
            observer: true,
            observeParents: true,
            observeSlideChildren: true,
            updateOnWindowResize: true,
            watchSlidesProgress: true,
            watchSlidesVisibility: true,
            
            // Responsive breakpoints
            breakpoints: {
                320: {
                    autoplay: {
                        delay: 5000
                    }
                },
                768: {
                    autoplay: {
                        delay: 6000
                    }
                },
                1024: {
                    autoplay: {
                        delay: 6000
                    }
                }
            },
            
            // Callbacks
            on: {
                init: function() {
                    // Remove loading class when initialized
                    if (heroSection) {
                        heroSection.classList.remove('loading');
                    }
                    
                    // Ensure first slide is visible
                    const firstSlide = this.slides[this.activeIndex];
                    if (firstSlide) {
                        firstSlide.classList.add('swiper-slide-active');
                    }
                },
                
                slideChange: function() {
                    // Optional: trigger custom events or analytics
                    // console.log('Slide changed to:', this.realIndex);
                },
                
                transitionStart: function() {
                    // Add transition class for custom animations
                    heroSwiperContainer.classList.add('transitioning');
                },
                
                transitionEnd: function() {
                    // Remove transition class
                    heroSwiperContainer.classList.remove('transitioning');
                },
                
                autoplayStop: function() {
                    // Optional: handle autoplay stop
                    // console.log('Autoplay stopped');
                },
                
                autoplayStart: function() {
                    // Optional: handle autoplay start
                    // console.log('Autoplay started');
                }
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!heroSwiper) return;
            
            switch(e.key) {
                case 'ArrowLeft':
                    heroSwiper.slidePrev();
                    e.preventDefault();
                    break;
                case 'ArrowRight':
                    heroSwiper.slideNext();
                    e.preventDefault();
                    break;
                case ' ': // Space bar
                    if (heroSwiper.autoplay.running) {
                        heroSwiper.autoplay.stop();
                    } else {
                        heroSwiper.autoplay.start();
                    }
                    e.preventDefault();
                    break;
            }
        });
        
        // Pause autoplay when user is interacting
        let userInteracting = false;
        
        heroSwiperContainer.addEventListener('mouseenter', function() {
            userInteracting = true;
        });
        
        heroSwiperContainer.addEventListener('mouseleave', function() {
            userInteracting = false;
        });
        
        // Visibility API - pause when tab is not visible
        document.addEventListener('visibilitychange', function() {
            if (!heroSwiper) return;
            
            if (document.hidden) {
                heroSwiper.autoplay.stop();
            } else if (!userInteracting) {
                heroSwiper.autoplay.start();
            }
        });
        
        // Intersection Observer for performance
        if ('IntersectionObserver' in window) {
            const heroObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        if (!heroSwiper.autoplay.running) {
                            heroSwiper.autoplay.start();
                        }
                    } else {
                        heroSwiper.autoplay.stop();
                    }
                });
            }, {
                threshold: 0.5
            });
            
            heroObserver.observe(heroSwiperContainer);
        }
    });
})();