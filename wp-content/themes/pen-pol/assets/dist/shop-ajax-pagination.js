/**
 * AJAX Pagination dla archiwum produktów w motywie Pen-pol
 * 
 * Obsługuje ładowanie produktów bez przeładowania strony oraz aktualizację URL
 * przy przełączaniu między stronami produktów.
 * 
 * @package Pen-pol
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // Sprawdź czy jQuery jest dostępne
    if (typeof $ === 'undefined') {
        console.error('jQuery jest wymagane do działania paginacji AJAX');
        return;
    }

    /**
     * Główna funkcja inicjalizująca paginację AJAX
     */
    function initAjaxPagination() {
        // Selektory elementów
        const productGrid = $('.product-grid');
        
        // Jeśli nie znaleziono potrzebnych elementów, przerwij
        if (!productGrid.length) {
            return;
        }

        // Dodaj obsługę kliknięcia na linki paginacji
        $(document).on('click', '.shop-archive__pagination a:not(.disabled)', function(e) {
            e.preventDefault();
            
            const pageUrl = $(this).attr('href');
            if (!pageUrl || pageUrl === '#') {
                return;
            }

            // Dodaj klasę ładowania do grida produktów
            productGrid.addClass('loading');

            // Pobierz nową stronę poprzez AJAX
            $.ajax({
                url: pageUrl,
                type: 'GET',
                success: function(response) {
                    // Wyciągnij produkty z odpowiedzi
                    const $response = $(response);
                    const newProducts = $response.find('.product-grid').html();
                    const newPagination = $response.find('.shop-archive__pagination').html();
                    
                    // Aktualizuj tylko produkty i paginację, zachowując resztę układu
                    if (newProducts && newProducts.length > 0) {
                        productGrid.html(newProducts);
                        
                        if (newPagination && newPagination.length > 0) {
                            $('.shop-archive__pagination').html(newPagination);
                        }
                        
                        // Aktualizuj URL bez przeładowania strony
                        history.pushState(null, '', pageUrl);
                        
                        // Zaktualizuj stan strzałek
                        updateArrowStates();
                        
                        // Zaktualizuj licznik produktów (woocommerce-result-count)
                        const newResultCount = $response.find('.woocommerce-result-count').html();
                        if (newResultCount) {
                            $('.woocommerce-result-count').html(newResultCount);
                        }
                    } else {
                        console.error('Nie znaleziono produktów w odpowiedzi AJAX');
                        // W przypadku braku produktów w odpowiedzi, przekieruj standardowo
                        window.location.href = pageUrl;
                    }
                    
                    // Usuń klasę ładowania
                    productGrid.removeClass('loading');
                },
                error: function(xhr, status, error) {
                    console.error('Błąd podczas ładowania produktów:', error);
                    productGrid.removeClass('loading');
                    
                    // W przypadku błędu po prostu przekieruj na stronę
                    window.location.href = pageUrl;
                }
            });
        });

        // Funkcja aktualizująca stan strzałek paginacji
        function updateArrowStates() {
            const currentPage = parseInt($('.shop-archive__pagination .page-numbers.current').text(), 10);
            let lastPage = $('.shop-archive__pagination .page-numbers:not(.dots, .prev, .next)').last().text();
            lastPage = parseInt(lastPage, 10);
            
            // Aktualizuj strzałkę "poprzednia"
            if (currentPage === 1) {
                $('.shop-archive__pagination-arrow--prev a').addClass('disabled').attr('aria-disabled', 'true').attr('tabindex', '-1');
            } else {
                $('.shop-archive__pagination-arrow--prev a').removeClass('disabled').removeAttr('aria-disabled').removeAttr('tabindex');
            }
            
            // Aktualizuj strzałkę "następna"
            if (currentPage === lastPage) {
                $('.shop-archive__pagination-arrow--next a').addClass('disabled').attr('aria-disabled', 'true').attr('tabindex', '-1');
            } else {
                $('.shop-archive__pagination-arrow--next a').removeClass('disabled').removeAttr('aria-disabled').removeAttr('tabindex');
            }
        }
        
        // Inicjalizuj stan strzałek
        updateArrowStates();
    }

    // Uruchom inicjalizację po załadowaniu dokumentu
    $(document).ready(function() {
        initAjaxPagination();
    });

})(jQuery);