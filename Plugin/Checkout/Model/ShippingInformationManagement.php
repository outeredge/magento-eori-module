<?php
namespace OuterEdge\Eori\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;

class ShippingInformationManagement
{
    protected $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository) {
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {

        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();

        if ($shippingAddressExtensionAttributes instanceof \Magento\Quote\Api\Data\AddressExtensionInterface) {
            $eoriNumber = $shippingAddressExtensionAttributes->getEoriNumber();
            $shippingAddress->setEoriNumber($eoriNumber);
        }

    }
}

