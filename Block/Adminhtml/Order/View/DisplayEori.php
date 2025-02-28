<?php

namespace OuterEdge\Eori\Block\Adminhtml\Order\View;

use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;

class DisplayEori extends AbstractOrder
{
    public function getEoriNumber()
    {
        return $this->getOrder()->getShippingAddress()->getEoriNumber();
    }
}