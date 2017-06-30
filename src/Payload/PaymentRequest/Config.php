<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

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

    public function __construct(
        ?string $callbackForm = null,
        ?string $callbackOk = null,
        ?string $callbackFail = null,
        ?string $callbackRedirect = null,
        ?string $callbackOpen = null,
        ?string $callbackNotification = null,
        ?string $callbackVerifyOrder = null
    ) {
    
        $this->setCallbackForm($callbackForm);
        $this->setCallbackOk($callbackOk);
        $this->setCallbackFail($callbackFail);
        $this->setCallbackRedirect($callbackRedirect);
        $this->setCallbackOpen($callbackOpen);
        $this->setCallbackNotification($callbackNotification);
        $this->setCallbackVerifyOrder($callbackVerifyOrder);
    }

    public function getPayload() : array
    {
        $payload = [
            'callback_form' => $this->getCallbackForm(),
            'callback_ok' => $this->getCallbackOk(),
            'callback_fail' => $this->getCallbackFail(),
            'callback_redirect' => $this->getCallbackRedirect(),
            'callback_open' => $this->getCallbackOpen(),
            'callback_notification' => $this->getCallbackNotification(),
            'callback_verify_order' => $this->getCallbackVerifyOrder(),
        ];

        return $this->cleanPayload($payload);
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
    public function setCallbackForm(?string $callbackForm) : self
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
    public function setCallbackOk(?string $callbackOk) : self
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
    public function setCallbackFail(?string $callbackFail) : self
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
    public function setCallbackRedirect(?string $callbackRedirect) : self
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
    public function setCallbackOpen(?string $callbackOpen) : self
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
    public function setCallbackNotification(?string $callbackNotification) : self
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
    public function setCallbackVerifyOrder(?string $callbackVerifyOrder) : self
    {
        $this->callbackVerifyOrder = $callbackVerifyOrder;
        return $this;
    }
}
