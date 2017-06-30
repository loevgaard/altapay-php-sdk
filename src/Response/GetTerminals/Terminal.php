<?php
namespace Loevgaard\AltaPay\Response\GetTerminals;

use Loevgaard\AltaPay\Response\GetTerminals\Terminal\Currency;
use Loevgaard\AltaPay\Response\GetTerminals\Terminal\Nature;
use Loevgaard\AltaPay\Response\PartialResponse;

class Terminal extends PartialResponse
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var Nature[]
     */
    protected $natures;

    /**
     * @var Currency[]
     */
    protected $currencies;

    protected function init()
    {
        $this->natures = [];
        $this->currencies = [];
        $this->title = (string)$this->xmlDoc->Title;
        $this->country = (string)$this->xmlDoc->Country;

        if (isset($this->xmlDoc->Natures) &&
            isset($this->xmlDoc->Natures->Nature) &&
            !empty($this->xmlDoc->Natures->Nature)) {
            foreach ($this->xmlDoc->Natures->Nature as $natureXml) {
                $this->natures[] = new Nature($this->getOriginalResponse(), $natureXml);
            }
        }

        if (isset($this->xmlDoc->Currencies) &&
            isset($this->xmlDoc->Currencies->Currency) &&
            !empty($this->xmlDoc->Currencies->Currency)) {
            foreach ($this->xmlDoc->Currencies->Currency as $currencyXml) {
                $this->currencies[] = new Currency($this->getOriginalResponse(), $currencyXml);
            }
        }
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return Nature[]
     */
    public function getNatures() : array
    {
        return $this->natures;
    }

    /**
     * @return Currency[]
     */
    public function getCurrencies() : array
    {
        return $this->currencies;
    }
}
