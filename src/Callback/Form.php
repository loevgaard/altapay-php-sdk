<?php

namespace Loevgaard\AltaPay\Callback;

class Form extends Callback
{
    /**
     * @var string
     */
    protected $shopOrderId;

    /**
     * @var float
     */
    protected $amount;

    /**
     * ISO 4217 currency code
     *
     * @var int
     */
    protected $currency;

    /**
     * ISO 639 alpha 2 language code
     *
     * @var string
     */
    protected $language;

    /**
     * @var boolean
     */
    protected $embeddedWindow;

    public function init()
    {
        $this->shopOrderId = $this->body['shop_orderid'];
        $this->amount = (float)$this->body['amount'];
        $this->currency = (int)$this->body['currency'];
        $this->language = $this->body['language'];
        $this->embeddedWindow = (int)$this->body['embedded_window'] === 1;
    }

    /**
     * @return string
     */
    public function getShopOrderId(): string
    {
        return $this->shopOrderId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getCurrency(): int
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return bool
     */
    public function isEmbeddedWindow(): bool
    {
        return $this->embeddedWindow;
    }
}
