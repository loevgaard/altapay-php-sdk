<?php
namespace Loevgaard\AltaPay\Response\Partial\Transaction\CustomerInfo;

use Loevgaard\AltaPay\Response\Partial\PartialResponse;

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

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }

    protected function init()
    {
        $this->country = (string)$this->xmlDoc->Country;
        $this->source = (string)$this->xmlDoc->Source;
    }
}
