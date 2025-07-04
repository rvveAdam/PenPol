/**
 * Hero Slider for Pen-pol Theme
 * WCAG 2.1 AA compliant slider functionality
 */
document.addEventListener('DOMContentLoaded', function() {
  // Check if hero slider exists
  const heroSlider = document.querySelector('.hero__slider.swiper');
  
  if (!heroSlider) {
    return;
  }
  
  // Initialize Swiper
  const heroSwiper = new Swiper('.hero__slider.swiper', {
    // Fade effect
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    
    // Transition speed
    speed: 800,
    
    // Autoplay settings
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true
    },
    
    // Loop through slides
    loop: true,
    
    // Navigation arrows
    navigation: {
      nextEl: '.hero__nav-button--next',
      prevEl: '.hero__nav-button--prev',
    },
    
    // Accessibility
    a11y: {
      enabled: true,
      prevSlideMessage: 'Poprzedni slajd',
      nextSlideMessage: 'Następny slajd',
      firstSlideMessage: 'To jest pierwszy slajd',
      lastSlideMessage: 'To jest ostatni slajd'
    }
  });
  
  // Respect reduced motion preferences
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    heroSwiper.params.speed = 0;
    heroSwiper.params.autoplay.delay = 7000; // Longer delay for reduced motion
  }
  
  // Pause autoplay when not in viewport
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        heroSwiper.autoplay.start();
      } else {
        heroSwiper.autoplay.stop();
      }
    });
  }, { threshold: 0.3 });
  
  observer.observe(heroSlider);
});