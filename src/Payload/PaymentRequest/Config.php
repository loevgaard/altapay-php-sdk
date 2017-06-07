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
     * @var string
     */
    protected $callbackVerifyOrder;

    public function __construct(
        $callbackForm = null,
        $callbackOk = null,
        $callbackFail = null,
        $callbackRedirect = null,
        $callbackOpen = null,
        $callbackNotification = null,
        $callbackVerifyOrder = null
    ) {
    
        $this->setCallbackForm($callbackForm);
        $this->setCallbackOk($callbackOk);
        $this->setCallbackFail($callbackFail);
        $this->setCallbackRedirect($callbackRedirect);
        $this->setCallbackOpen($callbackOpen);
        $this->setCallbackNotification($callbackNotification);
        $this->setCallbackVerifyOrder($callbackVerifyOrder);
    }

    public function getPayload()
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
    public function getCallbackForm()
    {
        return $this->callbackForm;
    }

    /**
     * @param string $callbackForm
     * @return Config
     */
    public function setCallbackForm($callbackForm)
    {
        $this->assertStringOrNull($callbackForm);
        $this->callbackForm = $callbackForm;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackOk()
    {
        return $this->callbackOk;
    }

    /**
     * @param string $callbackOk
     * @return Config
     */
    public function setCallbackOk($callbackOk)
    {
        $this->assertStringOrNull($callbackOk);
        $this->callbackOk = $callbackOk;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackFail()
    {
        return $this->callbackFail;
    }

    /**
     * @param string $callbackFail
     * @return Config
     */
    public function setCallbackFail($callbackFail)
    {
        $this->assertStringOrNull($callbackFail);
        $this->callbackFail = $callbackFail;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackRedirect()
    {
        return $this->callbackRedirect;
    }

    /**
     * @param string $callbackRedirect
     * @return Config
     */
    public function setCallbackRedirect($callbackRedirect)
    {
        $this->assertStringOrNull($callbackRedirect);
        $this->callbackRedirect = $callbackRedirect;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackOpen()
    {
        return $this->callbackOpen;
    }

    /**
     * @param string $callbackOpen
     * @return Config
     */
    public function setCallbackOpen($callbackOpen)
    {
        $this->assertStringOrNull($callbackOpen);
        $this->callbackOpen = $callbackOpen;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackNotification()
    {
        return $this->callbackNotification;
    }

    /**
     * @param string $callbackNotification
     * @return Config
     */
    public function setCallbackNotification($callbackNotification)
    {
        $this->assertStringOrNull($callbackNotification);
        $this->callbackNotification = $callbackNotification;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackVerifyOrder()
    {
        return $this->callbackVerifyOrder;
    }

    /**
     * @param string $callbackVerifyOrder
     * @return Config
     */
    public function setCallbackVerifyOrder($callbackVerifyOrder)
    {
        $this->assertStringOrNull($callbackVerifyOrder);
        $this->callbackVerifyOrder = $callbackVerifyOrder;
        return $this;
    }
}
