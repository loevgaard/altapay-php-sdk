<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo;

use Loevgaard\AltaPay\Response\PartialResponse;

class CountryOfOrigin extends PartialResponse
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $source;

    protected function init()
    {
        $this->country = (string)$this->xmlDoc->Country;
        $this->source = (string)$this->xmlDoc->Source;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}