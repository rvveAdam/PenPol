/**
 * Carousels Initialization
 * 
 * Initializes all carousel components across the site:
 * - Testimonials carousel
 * - Blog posts carousel (homepage and single post pages)
 * 
 * @package Pen-pol
 * @since 1.0.0
 */
document.addEventListener('DOMContentLoaded', function() {
  // ========================================================================
  // TESTIMONIALS CAROUSEL
  // ========================================================================
  const opinieCarousels = document.querySelectorAll('.opinie-carousel');
  
  if (opinieCarousels.length > 0) {
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
  }
  
  // ========================================================================
  // BLOG POSTS CAROUSEL - Works on homepage and single post pages
  // ========================================================================
  
  // Znajduje wszystkie karuzele wpisów (na stronie głównej i na podstronach wpisów)
  const blogSwipers = document.querySelectorAll('.blog-section__swiper, .single-post .blog-section__swiper');
  
  if (blogSwipers.length > 0) {
    blogSwipers.forEach(swiperElement => {
      new Swiper(swiperElement, {
        // Basic configuration
        slidesPerView: 1.25,
        spaceBetween: 15,
        grabCursor: true,
        speed: 600,
        
        // Pagination
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        
        // Responsive breakpoints
        breakpoints: {
          // Tablet
          768: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          // Desktop - wyłączenie swipera, aby grid działał prawidłowo
          1024: {
            enabled: false,
            slidesPerView: 4,
            spaceBetween: 25,
          }
        },
        
        // Accessibility
        a11y: {
          enabled: true,
          prevSlideMessage: 'Poprzedni wpis',
          nextSlideMessage: 'Następny wpis',
          firstSlideMessage: 'Pierwszy wpis',
          lastSlideMessage: 'Ostatni wpis',
          paginationBulletMessage: 'Przejdź do wpisu {{index}}',
          notificationClass: 'swiper-notification',
          containerMessage: 'Karuzela wpisów blogowych',
          containerRoleDescriptionMessage: 'karuzela',
          itemRoleDescriptionMessage: 'slajd'
        }
      });
    });
  }
});