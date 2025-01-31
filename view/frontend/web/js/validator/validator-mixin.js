define([
    'jquery',
], function ($) {
    'use strict';

    return function (validator) {
        validator.addRule(
            'validate-eori',
            function (value) {
                if (window.eoriRequired === false) {
                    return true;
                }

                // Define the regex pattern for EORI validation
                var eoriPattern = /^[A-Za-z]{2,4}(?=.{2,12}$)[-_\s0-9]*(?:[a-zA-Z][-_\s0-9]*){0,2}$/;

                // Check if the input matches the pattern
                if (!eoriPattern.test(value)) {
                    return false;
                }

                // Do a fetch request to validate EORI
                // TO DO: maybe create our own magento 2 module that does the request?
                // return new Promise(function (resolve) {
                //     fetch(`https://ec.europa.eu/taxation_customs/dds2/eos/eori_detail.jsp?Lang=en&EoriNumb=${encodeURIComponent(value)}`)
                //         .then(response => response.text())
                //         .then(text => {
                //             if (text.includes("No records found")) {
                //                 resolve(false);
                //             } else {
                //                 resolve(true);
                //             }
                //         })
                //         .catch(() => resolve(false));
                // });
            },
            $.mage.__("Invalid EORI number. Please enter a valid one.")
        );

        return validator;
    };
});
