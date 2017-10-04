<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Entity\ResultTrait;
use Loevgaard\AltaPay\Entity\Transaction;
use Loevgaard\AltaPay\Entity\TransactionsTrait;

class CaptureReservation extends Response
{
    use ResultTrait;
    use TransactionsTrait;

    /**
     * @var float
     */
    protected $captureAmount;

    /**
     * @var int
     */
    protected $captureCurrency;

    /**
     * @var string
     */
    protected $captureResult;

    /**
     * @var Transaction[]
     */
    protected $transactions;

    /**
     * @return float
     */
    public function getCaptureAmount() : float
    {
        return $this->captureAmount;
    }

    /**
     * @return int
     */
    public function getCaptureCurrency() : int
    {
        return $this->captureCurrency;
    }

    /**
     * @deprecated According to AltaPay documentation this is deprecated,
     * @see https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
     * @return string
     */
    public function getCaptureResult() : string
    {
        return $this->captureResult;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions() : array
    {
        return $this->transactions;
    }

    protected function init()
    {
        /** @var \SimpleXMLElement $body */
        $body = $this->xmlDoc->Body;

        $this->transactions     = [];
        $this->captureAmount    = (float)$body->CaptureAmount;
        $this->captureCurrency  = (int)$body->CaptureCurrency;
        $this->captureResult    = (string)$body->CaptureResult;
        $this->hydrateResult($body);
        $this->hydrateTransactions($body);
    }
}
