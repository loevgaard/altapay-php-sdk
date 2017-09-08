<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use Assert\Assert;
use Loevgaard\AltaPay\Payload\Payload;

class Config extends Payload implements ConfigInterface
{
    /**
     * @var string
     */
    protected $callbackForm;

    /**
     * @var string
     */
    protected $callbackOk;

    /**
     * @var string
     */
    protected $callbackFail;

    /**
     * @var string
     */
    protected $callbackRedirect;

    /**
     * @var string
     */
    protected $callbackOpen;

    /**
     * @var string
     */
    protected $callbackNotification;

    /**
     * @var string|null
     */
    protected $callbackVerifyOrder;

    public function getPayload() : array
    {
        $payload = [
            'callback_form' => $this->callbackForm,
            'callback_ok' => $this->callbackOk,
            'callback_fail' => $this->callbackFail,
            'callback_redirect' => $this->callbackRedirect,
            'callback_open' => $this->callbackOpen,
            'callback_notification' => $this->callbackNotification,
            'callback_verify_order' => $this->callbackVerifyOrder,
        ];

        $this->validate();

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::thatNullOr($this->callbackForm)->string();
        Assert::thatNullOr($this->callbackOk)->string();
        Assert::thatNullOr($this->callbackFail)->string();
        Assert::thatNullOr($this->callbackRedirect)->string();
        Assert::thatNullOr($this->callbackOpen)->string();
        Assert::thatNullOr($this->callbackNotification)->string();
        Assert::thatNullOr($this->callbackVerifyOrder)->string();
    }

    /**
     * @return string
     */
    public function getCallbackForm() : ?string
    {
        return $this->callbackForm;
    }

    /**
     * @param string $callbackForm
     * @return Config
     */
    public function setCallbackForm(string $callbackForm) : self
    {
        $this->callbackForm = $callbackForm;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackOk() : ?string
    {
        return $this->callbackOk;
    }

    /**
     * @param string $callbackOk
     * @return Config
     */
    public function setCallbackOk(string $callbackOk) : self
    {
        $this->callbackOk = $callbackOk;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackFail() : ?string
    {
        return $this->callbackFail;
    }

    /**
     * @param string $callbackFail
     * @return Config
     */
    public function setCallbackFail(string $callbackFail) : self
    {
        $this->callbackFail = $callbackFail;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackRedirect() : ?string
    {
        return $this->callbackRedirect;
    }

    /**
     * @param string $callbackRedirect
     * @return Config
     */
    public function setCallbackRedirect(string $callbackRedirect) : self
    {
        $this->callbackRedirect = $callbackRedirect;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackOpen() : ?string
    {
        return $this->callbackOpen;
    }

    /**
     * @param string $callbackOpen
     * @return Config
     */
    public function setCallbackOpen(string $callbackOpen) : self
    {
        $this->callbackOpen = $callbackOpen;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackNotification() : ?string
    {
        return $this->callbackNotification;
    }

    /**
     * @param string $callbackNotification
     * @return Config
     */
    public function setCallbackNotification(string $callbackNotification) : self
    {
        $this->callbackNotification = $callbackNotification;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackVerifyOrder() : ?string
    {
        return $this->callbackVerifyOrder;
    }

    /**
     * @param string $callbackVerifyOrder
     * @return Config
     */
    public function setCallbackVerifyOrder(string $callbackVerifyOrder) : self
    {
        $this->callbackVerifyOrder = $callbackVerifyOrder;
        return $this;
    }
}
