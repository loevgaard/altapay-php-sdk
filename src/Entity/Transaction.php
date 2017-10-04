<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Exception\XmlException;
use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class Transaction implements HydratableInterface
{
    use PaymentNatureServiceTrait;
    use PaymentInfosTrait;
    use CustomerInfoTrait;
    use ReconciliationIdentifiersTrait;
    use CreditCardExpiryTrait;

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
    private $authType;

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
    private $CVVCheckResult;

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
    private $creditedAmount;

    /**
     * @var float
     */
    private $recurringDefaultAmount;

    /**
     * @var float
     */
    private $surchargeAmount;

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
     * @var string
     */
    private $paymentSchemeName;

    /**
     * @var string
     */
    private $addressVerification;

    /**
     * @var string
     */
    private $addressVerificationDescription;

    /**
     * @var float
     */
    private $fraudRiskScore;

    /**
     * @var string
     */
    private $fraudExplanation;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->transactionId = (int)$xml->TransactionId;
        $this->paymentId = (string)$xml->PaymentId;
        $this->authType = isset($xml->AuthType) ? (string)$xml->AuthType : null;
        $this->cardStatus = (string)$xml->CardStatus;
        $this->creditCardToken = (string)$xml->CreditCardToken;
        $this->creditCardMaskedPan = (string)$xml->CreditCardMaskedPan;
        $this->threeDSecureResult = (string)$xml->ThreeDSecureResult;
        $this->liableForChargeback = (string)$xml->LiableForChargeback;
        $this->CVVCheckResult = isset($xml->CVVCheckResult) ? (string)$xml->CVVCheckResult : null;
        $this->blacklistToken = (string)$xml->BlacklistToken;
        $this->shopOrderId = (string)$xml->ShopOrderId;
        $this->shop = (string)$xml->Shop;
        $this->terminal = (string)$xml->Terminal;
        $this->transactionStatus = (string)$xml->TransactionStatus;
        $this->reasonCode = (string)$xml->ReasonCode;
        $this->merchantCurrency = (int)$xml->MerchantCurrency;
        $this->merchantCurrencyAlpha = (string)$xml->MerchantCurrencyAlpha;
        $this->cardHolderCurrency = (int)$xml->CardHolderCurrency;
        $this->cardHolderCurrencyAlpha = (string)$xml->CardHolderCurrencyAlpha;
        $this->reservedAmount = (float)$xml->ReservedAmount;
        $this->capturedAmount = (float)$xml->CapturedAmount;
        $this->refundedAmount = (float)$xml->RefundedAmount;
        $this->creditedAmount = isset($xml->CreditedAmount) ? (float)$xml->CreditedAmount : null;
        $this->recurringDefaultAmount = (float)$xml->RecurringDefaultAmount;
        $this->surchargeAmount = isset($xml->SurchargeAmount) ? (float)$xml->SurchargeAmount : null;
        $this->paymentNature = (string)$xml->PaymentNature;
        $this->paymentSchemeName = isset($xml->PaymentSchemeName) ? (string)$xml->PaymentSchemeName : null;
        $this->addressVerification = isset($xml->AddressVerification) ? (string)$xml->AddressVerification : null;
        $this->addressVerificationDescription = isset($xml->AddressVerificationDescription) ? (string)$xml->AddressVerificationDescription : null;
        $this->fraudRiskScore = (float)$xml->FraudRiskScore;
        $this->fraudExplanation = (string)$xml->FraudExplanation;
        $this->hydratePaymentNatureService($xml);
        $this->hydratePaymentInfos($xml);
        $this->hydrateCustomerInfo($xml);
        $this->hydrateReconciliationIdentifiers($xml);
        $this->hydrateCreditCardExpiry($xml);

        if (isset($xml->CreatedDate)) {
            $this->createdDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', (string)$xml->CreatedDate);
            if ($this->createdDate === false) {
                $exception = new XmlException('The created date format is wrong');
                $exception->setXmlElement($xml);
                throw $exception;
            }
        }

        if (isset($xml->UpdatedDate)) {
            $this->updatedDate = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', (string)$xml->UpdatedDate);
            if ($this->updatedDate === false) {
                $exception = new XmlException('The updated date format is wrong');
                $exception->setXmlElement($xml);
                throw $exception;
            }
        }
    }

    /**
     * @return int
     */
    public function getTransactionId() : ?int
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getPaymentId() : ?string
    {
        return $this->paymentId;
    }

    /**
     * @return string
     */
    public function getAuthType(): ?string
    {
        return $this->authType;
    }

    /**
     * @return string
     */
    public function getCardStatus() : ?string
    {
        return $this->cardStatus;
    }

    /**
     * @return string
     */
    public function getCreditCardToken() : ?string
    {
        return $this->creditCardToken;
    }

    /**
     * @return string
     */
    public function getCreditCardMaskedPan() : ?string
    {
        return $this->creditCardMaskedPan;
    }

    /**
     * @return string
     */
    public function getThreeDSecureResult() : ?string
    {
        return $this->threeDSecureResult;
    }

    /**
     * @return string
     */
    public function getLiableForChargeback() : ?string
    {
        return $this->liableForChargeback;
    }

    /**
     * @return string
     */
    public function getCVVCheckResult(): ?string
    {
        return $this->CVVCheckResult;
    }

    /**
     * @return string
     */
    public function getBlacklistToken() : ?string
    {
        return $this->blacklistToken;
    }

    /**
     * @return string
     */
    public function getShopOrderId() : ?string
    {
        return $this->shopOrderId;
    }

    /**
     * @return string
     */
    public function getShop() : ?string
    {
        return $this->shop;
    }

    /**
     * @return string
     */
    public function getTerminal() : ?string
    {
        return $this->terminal;
    }

    /**
     * @return string
     */
    public function getTransactionStatus() : ?string
    {
        return $this->transactionStatus;
    }

    /**
     * @return string
     */
    public function getReasonCode() : ?string
    {
        return $this->reasonCode;
    }

    /**
     * @return int
     */
    public function getMerchantCurrency() : ?int
    {
        return $this->merchantCurrency;
    }

    /**
     * @return string
     */
    public function getMerchantCurrencyAlpha() : ?string
    {
        return $this->merchantCurrencyAlpha;
    }

    /**
     * @return int
     */
    public function getCardHolderCurrency() : ?int
    {
        return $this->cardHolderCurrency;
    }

    /**
     * @return string
     */
    public function getCardHolderCurrencyAlpha() : ?string
    {
        return $this->cardHolderCurrencyAlpha;
    }

    /**
     * @return float
     */
    public function getReservedAmount() : ?float
    {
        return $this->reservedAmount;
    }

    /**
     * @return float
     */
    public function getCapturedAmount() : ?float
    {
        return $this->capturedAmount;
    }

    /**
     * @return float
     */
    public function getRefundedAmount() : ?float
    {
        return $this->refundedAmount;
    }

    /**
     * @return float
     */
    public function getCreditedAmount(): ?float
    {
        return $this->creditedAmount;
    }

    /**
     * @return float
     */
    public function getRecurringDefaultAmount() : ?float
    {
        return $this->recurringDefaultAmount;
    }

    /**
     * @return float
     */
    public function getSurchargeAmount(): ?float
    {
        return $this->surchargeAmount;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedDate() : ?\DateTimeImmutable
    {
        return $this->createdDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedDate() : ?\DateTimeImmutable
    {
        return $this->updatedDate;
    }

    /**
     * @return string
     */
    public function getPaymentNature() : ?string
    {
        return $this->paymentNature;
    }

    /**
     * @return float
     */
    public function getFraudRiskScore() : ?float
    {
        return $this->fraudRiskScore;
    }

    /**
     * @return string
     */
    public function getFraudExplanation() : ?string
    {
        return $this->fraudExplanation;
    }
}
