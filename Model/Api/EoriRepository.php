<?php
namespace OuterEdge\Eori\Model\Api;

use OuterEdge\Eori\Api\EoriRepositoryInterface;
use Davidvandertuijn\Eori\Validator as EoriValidator;

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
        $this->eoriValidator->validate($eori);

        return [['success' => $eori->isValid()]];
    }

}