(function($){
    function moveCheckoutErrors() {
        const $noticeGroup = $('.woocommerce-NoticeGroup.woocommerce-NoticeGroup-checkout');

        if ($noticeGroup.length) {
            console.log('[NOTICE MOVE] Znalazłem NoticeGroup. Przenoszę...');
            $('.checkout__main--inner .woocommerce-NoticeGroup-checkout').remove(); // na wypadek duplikatu
            $noticeGroup.prependTo('.checkout__main--inner');
        }
    }

    // Na wszelki wypadek — każdorazowo przy AJAX update
    $(document.body).on('updated_checkout checkout_error', function() {
        moveCheckoutErrors();
    });

    // fallback po kliknięciu przycisku (gdyby nic nie zadziałało)
    $(document).on('click', '#place_order', function() {
        setTimeout(moveCheckoutErrors, 50);
        setTimeout(moveCheckoutErrors, 200);
        setTimeout(moveCheckoutErrors, 1000); // backup
    });
})(jQuery);


function removeShippingTextNode() {
	const shippingRefresh = document.querySelector('.checkout__shipping-refresh');
	if (!shippingRefresh) return;

	const firstNode = shippingRefresh.firstChild;
	if (
		firstNode &&
		firstNode.nodeType === Node.TEXT_NODE &&
		firstNode.textContent.trim() === 'Wysyłka'
	) {
		firstNode.remove();
	}
}

// Na start
document.addEventListener('DOMContentLoaded', removeShippingTextNode);

// Po AJAX WooCommerce
jQuery(document.body).on('updated_checkout', removeShippingTextNode);



document.addEventListener('DOMContentLoaded', function() {
    // Przyciski akcji
    const loginBtn = document.querySelector('.btn-login-toggle');
    const couponBtn = document.querySelector('.btn-coupon-toggle');
    
    // Popupy
    const loginPopup = document.getElementById('checkout-login-popup');
    const couponPopup = document.getElementById('checkout-coupon-popup');
    
    // Otwieranie popupów po kliknięciu przycisków
    if (loginBtn && loginPopup) {
        loginBtn.addEventListener('click', function() {
            openPopup(loginPopup);
        });
    }
    
    if (couponBtn && couponPopup) {
        couponBtn.addEventListener('click', function() {
            openPopup(couponPopup);
        });
    }
    
    // Zamykanie popupów po kliknięciu przycisku zamknięcia lub tła
    document.querySelectorAll('.checkout-popup__close, .checkout-popup__overlay').forEach(function(el) {
        el.addEventListener('click', function() {
            const popup = this.closest('.checkout-popup');
            if (popup) {
                closePopup(popup);
            }
        });
    });
    
    // Zamykanie popupów po naciśnięciu Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.checkout-popup.active').forEach(function(popup) {
                closePopup(popup);
            });
        }
    });
    
    // Funkcje pomocnicze
    function openPopup(popup) {
        popup.classList.add('active');
        document.body.classList.add('popup-open');
    }
    
    function closePopup(popup) {
        popup.classList.add('closing');
        setTimeout(() => {
            popup.classList.remove('active');
            popup.classList.remove('closing');
            document.body.classList.remove('popup-open');
        }, 300);
    }
    
    // Sprawdź, czy są błędy po przeładowaniu strony
    const hasErrors = document.querySelectorAll('.woocommerce-error').length > 0;
    
    if (hasErrors) {
        // Sprawdź, czy błędy dotyczą kuponu
        document.querySelectorAll('.woocommerce-error').forEach(function(error) {
            const errorText = error.textContent.toLowerCase();
            
            if (errorText.includes('kupon') || errorText.includes('kod') || errorText.includes('coupon')) {
                // Błąd dotyczy kuponu, otwórz popup kuponu
                if (couponPopup) {
                    openPopup(couponPopup);
                }
            } else if (errorText.includes('login') || errorText.includes('hasło') || errorText.includes('password')) {
                // Błąd dotyczy logowania, otwórz popup logowania
                if (loginPopup) {
                    openPopup(loginPopup);
                }
            }
        });
    }
});