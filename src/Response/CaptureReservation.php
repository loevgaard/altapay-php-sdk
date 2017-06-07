<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Response\CaptureReservation\Transaction;

class CaptureReservation extends Response
{
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
    protected $result;

    /**
     * @var string
     */
    protected $captureResult;

    /**
     * @var Transaction[]
     */
    protected $transactions;

    protected function init()
    {
        $this->transactions     = [];
        $this->captureAmount    = (float)$this->xmlDoc->Body->CaptureAmount;
        $this->captureCurrency  = (int)$this->xmlDoc->Body->CaptureCurrency;
        $this->result           = (string)$this->xmlDoc->Body->Result;
        $this->captureResult    = (string)$this->xmlDoc->Body->CaptureResult;

        if (isset($this->xmlDoc->Body->Transactions) && isset($this->xmlDoc->Body->Transactions->Transaction) && !empty($this->xmlDoc->Body->Transactions->Transaction)) {
            foreach ($this->xmlDoc->Body->Transactions->Transaction as $transactionXml) {
                $transaction = new Transaction($this->getResponse(), $transactionXml);
                $this->transactions[] = $transaction;
            }
        }
    }

    /**
     * @return float
     */
    public function getCaptureAmount()
    {
        return $this->captureAmount;
    }

    /**
     * @return int
     */
    public function getCaptureCurrency()
    {
        return $this->captureCurrency;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @deprecated According to AltaPay documentation this is deprecated, see https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
     * @return string
     */
    public function getCaptureResult()
    {
        return $this->captureResult;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
