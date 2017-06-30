<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation;

use Loevgaard\AltaPay\Exception\ResponseException;
use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo;
use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\PaymentInfo;
use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\PaymentNatureService;
use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\ReconciliationIdentifier;
use Loevgaard\AltaPay\Response\PartialResponse;

class Transaction extends PartialResponse
{
    /**
     * @var int
     */
    private $transactionId;

    /**
     * @var string
     */
    private $paymentId;

    /**
     * @var string
     */
    private $cardStatus;

    /**
     * @var string
     */
    private $creditCardToken;

    /**
     * @var string
     */
    private $creditCardMaskedPan;

    /**
     * @var string
     */
    private $threeDSecureResult;

    /**
     * @var string
     */
    private $liableForChargeback;

    /**
     * @var string
     */
    private $blacklistToken;

    /**
     * @var string
     */
    private $shopOrderId;

    /**
     * @var string
     */
    private $shop;

    /**
     * @var string
     */
    private $terminal;

    /**
     * @var string
     */
    private $transactionStatus;

    /**
     * @var string
     */
    private $reasonCode;

    /**
     * @var int
     */
    private $merchantCurrency;

    /**
     * @var string
     */
    private $merchantCurrencyAlpha;

    /**
     * @var int
     */
    private $cardHolderCurrency;

    /**
     * @var string
     */
    private $cardHolderCurrencyAlpha;

    /**
     * @var float
     */
    private $reservedAmount;

    /**
     * @var float
     */
    private $capturedAmount;

    /**
     * @var float
     */
    private $refundedAmount;

    /**
     * @var float
     */
    private $recurringDefaultAmount;

    /**
     * @var \DateTimeImmutable
     */
    private $createdDate;

    /**
     * @var \DateTimeImmutable
     */
    private $updatedDate;

    /**
     * @var string
     */
    private $paymentNature;

    /**
     * @var PaymentNatureService
     */
    private $paymentNatureService;

    /**
     * @var float
     */
    private $fraudRiskScore;

    /**
     * @var string
     */
    private $fraudExplanation;

    /**
     * @var PaymentInfo[]
     */
    private $paymentInfos;

    /**
     * @var CustomerInfo
     */
    private $customerInfo;

    /**
     * @var ReconciliationIdentifier[]
     */
    private $reconciliationIdentifiers;

    protected function init()
    {
        $this->transactionId = (int)$this->xmlDoc->TransactionId;
        $this->paymentId = (string)$this->xmlDoc->PaymentId;
        $this->cardStatus = (string)$this->xmlDoc->CardStatus;
        $this->creditCardToken = (string)$this->xmlDoc->CreditCardToken;
        $this->creditCardMaskedPan = (string)$this->xmlDoc->CreditCardMaskedPan;
        $this->threeDSecureResult = (string)$this->xmlDoc->ThreeDSecureResult;
        $this->liableForChargeback = (string)$this->xmlDoc->LiableForChargeback;
        $this->blacklistToken = (string)$this->xmlDoc->BlacklistToken;
        $this->shopOrderId = (string)$this->xmlDoc->ShopOrderId;
        $this->shop = (string)$this->xmlDoc->Shop;
        $this->terminal = (string)$this->xmlDoc->Terminal;
        $this->transactionStatus = (string)$this->xmlDoc->TransactionStatus;
        $this->reasonCode = (string)$this->xmlDoc->ReasonCode;
        $this->merchantCurrency = (int)$this->xmlDoc->MerchantCurrency;
        $this->merchantCurrencyAlpha = (string)$this->xmlDoc->MerchantCurrencyAlpha;
        $this->cardHolderCurrency = (int)$this->xmlDoc->CardHolderCurrency;
        $this->cardHolderCurrencyAlpha = (string)$this->xmlDoc->CardHolderCurrencyAlpha;
        $this->reservedAmount = (float)$this->xmlDoc->ReservedAmount;
        $this->capturedAmount = (float)$this->xmlDoc->CapturedAmount;
        $this->refundedAmount = (float)$this->xmlDoc->RefundedAmount;
        $this->recurringDefaultAmount = (float)$this->xmlDoc->RecurringDefaultAmount;
        $this->paymentNature = (string)$this->xmlDoc->PaymentNature;
        $this->fraudRiskScore = (float)$this->xmlDoc->FraudRiskScore;
        $this->fraudExplanation = (string)$this->xmlDoc->FraudExplanation;

        $this->createdDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', (string)$this->xmlDoc->CreatedDate);
        if ($this->createdDate === false) {
            $exception = new ResponseException('The created date format is wrong');
            $exception->setResponse($this->getOriginalResponse());
            throw $exception;
        }

        $this->updatedDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', (string)$this->xmlDoc->UpdatedDate);
        if ($this->updatedDate === false) {
            $exception = new ResponseException('The updated date format is wrong');
            $exception->setResponse($this->getOriginalResponse());
            throw $exception;
        }

        // populating payment nature service object
        $this->paymentNatureService = new PaymentNatureService(
            $this->getOriginalResponse(),
            $this->xmlDoc->PaymentNatureService
        );

        // populating payment info objects
        $this->paymentInfos = [];
        if (isset($this->xmlDoc->PaymentInfos) &&
            isset($this->xmlDoc->PaymentInfos->PaymentInfo) &&
            !empty($this->xmlDoc->PaymentInfos->PaymentInfo)) {
            foreach ($this->xmlDoc->PaymentInfos->PaymentInfo as $paymentInfo) {
                $this->paymentInfos[] = new PaymentInfo($this->getOriginalResponse(), $paymentInfo);
            }
        }

        // populating customer info object
        $this->customerInfo = new Transaction\CustomerInfo($this->getOriginalResponse(), $this->xmlDoc->CustomerInfo);

        // populating reconciliation identifiers
        $this->reconciliationIdentifiers = [];
        if (isset($this->xmlDoc->ReconciliationIdentifiers) &&
            isset($this->xmlDoc->ReconciliationIdentifiers->ReconciliationIdentifier) &&
            !empty($this->xmlDoc->ReconciliationIdentifiers->ReconciliationIdentifier)) {
            foreach ($this->xmlDoc->ReconciliationIdentifiers->ReconciliationIdentifier as $reconciliationIdentifier) {
                $this->reconciliationIdentifiers[] = new ReconciliationIdentifier(
                    $this->getOriginalResponse(),
                    $reconciliationIdentifier
                );
            }
        }
    }

    /**
     * @return int
     */
    public function getTransactionId() : int
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getPaymentId() : string
    {
        return $this->paymentId;
    }

    /**
     * @return string
     */
    public function getCardStatus() : string
    {
        return $this->cardStatus;
    }

    /**
     * @return string
     */
    public function getCreditCardToken() : string
    {
        return $this->creditCardToken;
    }

    /**
     * @return string
     */
    public function getCreditCardMaskedPan() : string
    {
        return $this->creditCardMaskedPan;
    }

    /**
     * @return string
     */
    public function getThreeDSecureResult() : string
    {
        return $this->threeDSecureResult;
    }

    /**
     * @return string
     */
    public function getLiableForChargeback() : string
    {
        return $this->liableForChargeback;
    }

    /**
     * @return string
     */
    public function getBlacklistToken() : string
    {
        return $this->blacklistToken;
    }

    /**
     * @return string
     */
    public function getShopOrderId() : string
    {
        return $this->shopOrderId;
    }

    /**
     * @return string
     */
    public function getShop() : string
    {
        return $this->shop;
    }

    /**
     * @return string
     */
    public function getTerminal() : string
    {
        return $this->terminal;
    }

    /**
     * @return string
     */
    public function getTransactionStatus() : string
    {
        return $this->transactionStatus;
    }

    /**
     * @return string
     */
    public function getReasonCode() : string
    {
        return $this->reasonCode;
    }

    /**
     * @return int
     */
    public function getMerchantCurrency() : int
    {
        return $this->merchantCurrency;
    }

    /**
     * @return string
     */
    public function getMerchantCurrencyAlpha() : string
    {
        return $this->merchantCurrencyAlpha;
    }

    /**
     * @return int
     */
    public function getCardHolderCurrency() : int
    {
        return $this->cardHolderCurrency;
    }

    /**
     * @return string
     */
    public function getCardHolderCurrencyAlpha() : string
    {
        return $this->cardHolderCurrencyAlpha;
    }

    /**
     * @return float
     */
    public function getReservedAmount() : float
    {
        return $this->reservedAmount;
    }

    /**
     * @return float
     */
    public function getCapturedAmount() : float
    {
        return $this->capturedAmount;
    }

    /**
     * @return float
     */
    public function getRefundedAmount() : float
    {
        return $this->refundedAmount;
    }

    /**
     * @return float
     */
    public function getRecurringDefaultAmount() : float
    {
        return $this->recurringDefaultAmount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedDate() : \DateTimeImmutable
    {
        return $this->createdDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedDate() : \DateTimeImmutable
    {
        return $this->updatedDate;
    }

    /**
     * @return string
     */
    public function getPaymentNature() : string
    {
        return $this->paymentNature;
    }

    /**
     * @return PaymentNatureService
     */
    public function getPaymentNatureService()
    {
        return $this->paymentNatureService;
    }

    /**
     * @return float
     */
    public function getFraudRiskScore() : float
    {
        return $this->fraudRiskScore;
    }

    /**
     * @return string
     */
    public function getFraudExplanation() : string
    {
        return $this->fraudExplanation;
    }

    /**
     * @return PaymentInfo[]
     */
    public function getPaymentInfos() : array
    {
        return $this->paymentInfos;
    }

    /**
     * @return CustomerInfo
     */
    public function getCustomerInfo() : CustomerInfo
    {
        return $this->customerInfo;
    }

    /**
     * @return ReconciliationIdentifier[]
     */
    public function getReconciliationIdentifiers() : array
    {
        return $this->reconciliationIdentifiers;
    }
}
