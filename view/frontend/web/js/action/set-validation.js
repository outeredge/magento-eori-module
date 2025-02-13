define(["jquery"], function ($) {
    "use strict";
    if (!$('.checkout-index-index').length) return;

    var isEU = false;
    window.eoriRequired = false;

    function waitForElement(selector, callback, checkFrequencyInMs) {
        (function loopSearch() {
          if (document.querySelector(selector) != null) {
            callback();
            return;
          }
          else {
            setTimeout(function () {
              loopSearch();
            }, checkFrequencyInMs);
          }
        })();
    }

    const setEoriNumber = function() {
        waitForElement('[name="shippingAddress.custom_attributes.eori_number"]', function() {
            checkInputs();
        }, 1000);
    }

    const checkInputs = function() {
        const EU_COUNTRIES = [
            'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR',
            'HU', 'IE', 'IT', 'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK',
            'SI', 'ES', 'SE'
        ];

        waitForElement('[name="country_id"]', function() {
            // Detect country change and initiate EORI listeners
            $('[name="country_id"]').change(function() {
                var countryCode = $(this).val();
                isEU = EU_COUNTRIES.includes(countryCode);
                toggleElement();
                isRequired();
            });

            var initialCountry = $('[name="country_id"]').val();
            isEU = EU_COUNTRIES.includes(initialCountry);

            // init EORI field
            toggleElement();
            isRequired();
        });
    };


    const isRequired = function () {
        if (isEU == true) {
            document.querySelector('[name="shippingAddress.custom_attributes.eori_number"]').classList.add('_required');
        } else {
            document.querySelector('[name="shippingAddress.custom_attributes.eori_number"]').classList.remove('_required');
        }
    }

    const toggleElement = function() {
        if (isEU == true) {
            document.querySelector('[name="shippingAddress.custom_attributes.eori_number"]').style.display = 'block';
            window.eoriRequired = true;
        } else {
            document.querySelector('[name="shippingAddress.custom_attributes.eori_number"]').style.display = 'none';
            window.eoriRequired = false;
        }
    }

    setEoriNumber()
});
