<?php

namespace Loevgaard\AltaPay\Entity;

trait CurrenciesTrait
{
    /**
     * @var Currency[]
     */
    protected $currencies;

    /**
     * @return Currency[]
     */
    public function getCurrencies(): array
    {
        $this->initializeCurrencies();

        return $this->currencies;
    }

    /**
     * @param array $currencies
     */
    public function setCurrencies(array $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @param Currency $currency
     */
    public function addCurrency(Currency $currency)
    {
        $this->initializeCurrencies();

        $this->currencies[] = $currency;
    }

    public function hydrateCurrencies(\SimpleXMLElement $xml)
    {
        $this->initializeCurrencies();

        if (isset($xml->Currencies) && isset($xml->Currencies->Currency) && !empty($xml->Currencies->Currency)) {
            foreach ($xml->Currencies->Currency as $currencyXml) {
                $currency = new Currency();
                $currency->hydrateXml($currencyXml);
                $this->currencies[] = $currency;
            }
        }
    }

    private function initializeCurrencies()
    {
        if (is_null($this->currencies)) {
            $this->currencies = [];
        }
    }
}
