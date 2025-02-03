<?php
namespace OuterEdge\Eori\Api;

interface EoriRepositoryInterface
{
    /**
     * @param string $eori
     * @return bool true on success
     */
    public function validation(string $eori);
}
