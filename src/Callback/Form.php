<?php

namespace Loevgaard\AltaPay\Callback;

use Loevgaard\AltaPay;
use Money\Money;
use Psr\Http\Message\ServerRequestInterface;

class Form extends Callback
{
    /**
     * @var string
     */
    protected $shopOrderId;

    /**
     * @var Money
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
        $currency = (int)$this->body['currency'];
        $alphaCurrency = AltaPay\alphaCurrencyFromNumeric($currency);

        $this->shopOrderId = $this->body['shop_orderid'];
        $this->amount = AltaPay\createMoneyFromFloat($alphaCurrency, (float)$this->body['amount']);
        $this->currency = $currency;
        $this->language = $this->body['language'];
        $this->embeddedWindow = (int)($this->body['embedded_window'] === 1);
    }

    public static function initable(ServerRequestInterface $request): bool
    {
        $body = static::getBodyFromRequest($request);

        return isset($body['shop_orderid']) && isset($body['amount']) && isset($body['currency']) && isset($body['language']) && isset($body['embedded_window']);
    }

    /**
     * @return string
     */
    public function getShopOrderId(): string
    {
        return $this->shopOrderId;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
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
