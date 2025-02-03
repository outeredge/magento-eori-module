<?php
namespace OuterEdge\Eori\Model\Api;

use OuterEdge\Eori\Api\EoriRepositoryInterface;
use Davidvandertuijn\Eori\Validator as EoriValidator;
use Magento\Framework\Webapi\Exception;
use Magento\Framework\Phrase;

class EoriRepository implements EoriRepositoryInterface
{
    public function __construct(
        protected EoriValidator $eoriValidator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function validation($eori)
    {
        try {
            $this->eoriValidator->validate($eori);
        } catch (\Exception $exception) {
            throw new Exception(new Phrase($exception->getMessage()));
        }

        return [['success' => $this->eoriValidator->isValid()]];
    }
}
