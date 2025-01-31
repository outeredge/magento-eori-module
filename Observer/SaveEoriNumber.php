<?php

namespace OuterEdge\Eori\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveEoriNumber implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');
        $shippingAddressData = $quote->getShippingAddress()->getData();

        if (isset($shippingAddressData['eori_number'])) {
            $order->getShippingAddress()->setEoriNumber($shippingAddressData['eori_number']);
            $order->addCommentToStatusHistory('EORI Number: ' . $shippingAddressData['eori_number']);
        }

        return $this;
    }

}
