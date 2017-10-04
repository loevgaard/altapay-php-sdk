<?php

namespace Loevgaard\AltaPay\Entity;

trait ResultTrait
{
    /**
     * @var string
     */
    protected $result;


    public function hydrateResult(\SimpleXMLElement $xml)
    {
        $this->result = (string)$xml->Result;
    }

    /**
     * @return string
     */
    public function getResult() : string
    {
        return $this->result;
    }
}
