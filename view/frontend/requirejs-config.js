var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'OuterEdge_Eori/js/action/set-shipping-information-mixin': true
            },
            'Magento_Ui/js/lib/validation/validator': {
                'OuterEdge_Eori/js/validator/validator-mixin': true
            }
        }
    },
    deps: ["OuterEdge_Eori/js/action/set-validation"]
};
