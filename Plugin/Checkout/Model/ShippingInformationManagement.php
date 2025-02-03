<?php
namespace OuterEdge\Eori\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;
use Magento\Framework\Exception\InputException;
use Davidvandertuijn\Eori\Validator as EoriValidator;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Phrase;

class ShippingInformationManagement
{
    public function __construct(
        protected QuoteRepository $quoteRepository,
        protected EoriValidator $eoriValidator,
        protected Logger $logger
    ) {
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
            if (!empty($eoriNumber)) {

                try {
                    if (!$this->eoriValidator->validate($eoriNumber)) {
                        throw new InputException(
                            __('Invalid EORI number. Please enter a valid one.')
                        );
                    }
                } catch (\Exception $e) {
                    $this->logger->critical($e);
                    throw new InputException(new Phrase($e->getMessage()));
                }
                $shippingAddress->setEoriNumber($eoriNumber);
            }
        }
    }
}
