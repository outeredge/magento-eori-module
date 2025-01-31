<?php

namespace OuterEdge\Eori\Plugin\Checkout\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Checkout\Block\Checkout\LayoutProcessor as CheckoutLayerprocessor;

class LayoutProcessor
{
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterProcess(CheckoutLayerprocessor $subject, array $jsLayout)
    {
        $config = $this->scopeConfig->getValue('checkout/options/show_eori_number', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $flag = false;
        if ($config) {
            $flag = true;
        }

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['eori_number'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'eori-number'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.eori_number',
            'label' => 'EORI Number',
            'provider' => 'checkoutProvider',
            'visible' => $flag,
            'validation' => 'validate-eori',
            'sortOrder' => 252,
            'tooltip' => [
                'description' => 'ToDo description'
            ],
            'id' => 'eori-number'
        ];

        return $jsLayout;
    }
}
