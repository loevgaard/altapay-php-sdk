<?php
namespace Loevgaard\AltaPay\Response\GetTerminals\Terminal;

use Loevgaard\AltaPay\Response\PartialResponse;

class Currency extends PartialResponse
{
    /**
     * @var string
     */
    protected $currency;

    public function __toString() : string
    {
        return (string)$this->currency;
    }

    protected function init()
    {
        $this->currency = (string)$this->xmlDoc;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
