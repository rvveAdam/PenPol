/**
 * Home Testimonials Carousel Initialization
 * 
 * @package Pen-pol
 * @since 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize all testimonial carousels
  const opinieCarousels = document.querySelectorAll('.opinie-carousel');
  
  if (opinieCarousels.length === 0) return;
  
  opinieCarousels.forEach(carousel => {
    const swiper = new Swiper(carousel, {
      // Infinite loop
      loop: true,
      
      // Auto play with 5 second delay
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
      },
      
      // Slide transition
      speed: 800,
      
      // Responsive breakpoints
      breakpoints: {
        // Mobile (default)
        0: {
          slidesPerView: 1,
          spaceBetween: 16
        },
        // Tablet
        768: {
          slidesPerView: 2,
          spaceBetween: 16
        },
        // Desktop
        1024: {
          slidesPerView: 3.5, // Pokazuje 3 pełne kafelki + połowę czwartego
          spaceBetween: 24
        }
      },
      
      // Accessibility
      a11y: {
        enabled: true,
        prevSlideMessage: 'Poprzednia opinia',
        nextSlideMessage: 'Następna opinia',
        firstSlideMessage: 'Pierwsza opinia',
        lastSlideMessage: 'Ostatnia opinia',
        paginationBulletMessage: 'Przejdź do opinii {{index}}',
        notificationClass: 'swiper-notification',
        containerMessage: 'Karuzela opinii klientów',
        containerRoleDescriptionMessage: 'karuzela',
        itemRoleDescriptionMessage: 'slajd'
      }
    });
  });
});