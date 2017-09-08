<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;
use Loevgaard\AltaPay\Payload\PaymentRequest\Config;
use Loevgaard\AltaPay\Payload\PaymentRequest\ConfigInterface;
use Loevgaard\AltaPay\Payload\PaymentRequest\CustomerInfo;
use Loevgaard\AltaPay\Payload\PaymentRequest\CustomerInfoInterface;

class PaymentRequest extends Payload implements PaymentRequestInterface
{
    use OrderLineArrayTrait;

    const ACCOUNT_OFFER_REQUIRED = 'required';
    const ACCOUNT_OFFER_DISABLED = 'disabled';

    const PAYMENT_SOURCE_ECOMMERCE = 'eCommerce';
    const PAYMENT_SOURCE_MOBI = 'mobi';
    const PAYMENT_SOURCE_MOTO = 'moto';
    const PAYMENT_SOURCE_MAIL_ORDER = 'mail_order';
    const PAYMENT_SOURCE_TELEPHONE_ORDER = 'telephone_order';

    const SHIPPING_METHOD_LOW_COST = 'LowCost';
    const SHIPPING_METHOD_DESIGNATED_BY_CUSTOMER = 'DesignatedByCustomer';
    const SHIPPING_METHOD_INTERNATIONAL = 'International';
    const SHIPPING_METHOD_MILITARY = 'Military';
    const SHIPPING_METHOD_NEXT_DAY = 'NextDay';
    const SHIPPING_METHOD_OTHER = 'Other';
    const SHIPPING_METHOD_STORE_PICKUP = 'StorePickup';
    const SHIPPING_METHOD_TWO_DAY_SERVICE = 'TwoDayService';
    const SHIPPING_METHOD_THREE_DAY_SERVICE = 'ThreeDayService';

    /**
     * @var string
     */
    private $terminal;

    /**
     * @var string
     */
    private $shopOrderId;

    /**
     * @var float
     */
    private $amount;

    /**
     * Currency in ISO-4217 format
     *
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $language;

    /**
     * @var array
     */
    private $transactionInfo;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $ccToken;

    /**
     * @var string
     */
    private $saleReconciliationIdentifier;

    /**
     * @var string
     */
    private $saleInvoiceNumber;

    /**
     * @var float
     */
    private $salesTax;

    /**
     * @var array
     */
    private $cookieParts;

    /**
     * @var string
     */
    private $paymentSource;

    /**
     * @var string
     */
    private $fraudService;

    /**
     * @var string
     */
    private $shippingMethod;

    /**
     * @var \DateTimeInterface
     */
    private $customerCreatedDate;

    /**
     * @var string
     */
    private $organisationNumber;

    /**
     * @var string
     */
    private $accountOffer;

    /**
     * @var CustomerInfoInterface
     */
    private $customerInfo;

    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct(string $terminal, string $shopOrderId, float $amount, string $currency)
    {
        $this->cookieParts = [];
        $this->orderLines = [];
        $this->terminal = $terminal;
        $this->shopOrderId = $shopOrderId;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public function getPayload() : array
    {
        $cookie = static::parseCookieParts($this->cookieParts);

        $payload = [
            'terminal' => $this->terminal,
            'shop_orderid' => $this->shopOrderId,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'language' => $this->language,
            'transaction_info' => $this->transactionInfo,
            'type' => $this->type,
            'ccToken' => $this->ccToken,
            'sale_reconciliation_identifier' => $this->saleReconciliationIdentifier,
            'sale_invoice_number' => $this->saleInvoiceNumber,
            'sales_tax' => $this->salesTax,
            'cookie' => $cookie,
            'payment_source' => $this->paymentSource,
            'fraud_service' => $this->fraudService,
            'shipping_method' => $this->shippingMethod,
            'customer_created_date' => $this->customerCreatedDate ? $this->customerCreatedDate->format('Y-m-d') : null,
            'organisation_number' => $this->organisationNumber,
            'account_offer' => $this->accountOffer,
            'config' => $this->getConfig(),
            'customer_info' => $this->getCustomerInfo(),
            'orderLines' => $this->orderLines,
        ];

        $this->validate();

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->terminal)->string();
        Assert::that($this->shopOrderId)->string();
        Assert::that($this->amount)->float();
        Assert::that($this->currency)->string();
        Assert::thatNullOr($this->language)->string();
        Assert::thatNullOr($this->transactionInfo)->isArray();
        Assert::thatNullOr($this->type)->string();
        Assert::thatNullOr($this->ccToken)->string();
        Assert::thatNullOr($this->saleReconciliationIdentifier)->string();
        Assert::thatNullOr($this->saleInvoiceNumber)->string();
        Assert::thatNullOr($this->salesTax)->float();
        Assert::thatNullOr($this->paymentSource)->string();
        Assert::thatNullOr($this->fraudService)->string();
        Assert::thatNullOr($this->shippingMethod)->string();
        Assert::thatNullOr($this->customerCreatedDate)->isInstanceOf(\DateTimeInterface::class);
        Assert::thatNullOr($this->organisationNumber)->string();
        Assert::thatNullOr($this->accountOffer)->string();
        Assert::thatNullOr($this->orderLines)->isArray();
    }

    /**
     * Takes an array of cookie parts and returns an urlencoded string ready to send
     *
     * @param array $cookieParts
     * @return string
     */
    public static function parseCookieParts(array $cookieParts)
    {
        $cookie = '';
        foreach ($cookieParts as $key => $val) {
            $cookie .= $key.'='.rawurlencode($val).';';
        }
        $cookie = trim($cookie, ';');

        return $cookie;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getCookiePart(string $key) : string
    {
        return isset($this->cookieParts[$key]) ? $this->cookieParts[$key] : '';
    }

    /**
     * @param string $key
     * @param string $value
     * @return PaymentRequest
     */
    public function setCookiePart(string $key, string $value) : self
    {
        $this->cookieParts[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerminal() : string
    {
        return $this->terminal;
    }

    /**
     * @param string $terminal
     * @return PaymentRequest
     */
    public function setTerminal(string $terminal) : self
    {
        $this->terminal = $terminal;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopOrderId() : string
    {
        return $this->shopOrderId;
    }

    /**
     * @param string $shopOrderId
     * @return PaymentRequest
     */
    public function setShopOrderId(string $shopOrderId) : self
    {
        $this->shopOrderId = $shopOrderId;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return PaymentRequest
     */
    public function setAmount(float $amount) : self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return PaymentRequest
     */
    public function setCurrency(string $currency) : self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage() : ?string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return PaymentRequest
     */
    public function setLanguage(string $language) : self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return array
     */
    public function getTransactionInfo() : ?array
    {
        return $this->transactionInfo;
    }

    /**
     * @param array $transactionInfo
     * @return PaymentRequest
     */
    public function setTransactionInfo(array $transactionInfo) : self
    {
        $this->transactionInfo = $transactionInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return PaymentRequest
     */
    public function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getCcToken() : ?string
    {
        return $this->ccToken;
    }

    /**
     * @param string $ccToken
     * @return PaymentRequest
     */
    public function setCcToken(string $ccToken) : self
    {
        $this->ccToken = $ccToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleReconciliationIdentifier() : ?string
    {
        return $this->saleReconciliationIdentifier;
    }

    /**
     * @param string $saleReconciliationIdentifier
     * @return PaymentRequest
     */
    public function setSaleReconciliationIdentifier(string $saleReconciliationIdentifier) : self
    {
        $this->saleReconciliationIdentifier = $saleReconciliationIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleInvoiceNumber() : ?string
    {
        return $this->saleInvoiceNumber;
    }

    /**
     * @param string $saleInvoiceNumber
     * @return PaymentRequest
     */
    public function setSaleInvoiceNumber(string $saleInvoiceNumber) : self
    {
        $this->saleInvoiceNumber = $saleInvoiceNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalesTax() : ?float
    {
        return $this->salesTax;
    }

    /**
     * @param float $salesTax
     * @return PaymentRequest
     */
    public function setSalesTax(float $salesTax) : self
    {
        $this->salesTax = $salesTax;
        return $this;
    }

    /**
     * @return array
     */
    public function getCookieParts(): array
    {
        return $this->cookieParts;
    }

    /**
     * @param array $cookieParts
     * @return PaymentRequest
     */
    public function setCookieParts(array $cookieParts) : self
    {
        $this->cookieParts = $cookieParts;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentSource() : ?string
    {
        return $this->paymentSource;
    }

    /**
     * @param string $paymentSource
     * @return PaymentRequest
     */
    public function setPaymentSource(string $paymentSource) : self
    {
        $this->paymentSource = $paymentSource;
        return $this;
    }

    /**
     * @return string
     */
    public function getFraudService() : ?string
    {
        return $this->fraudService;
    }

    /**
     * @param string $fraudService
     * @return PaymentRequest
     */
    public function setFraudService(string $fraudService) : self
    {
        $this->fraudService = $fraudService;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingMethod() : ?string
    {
        return $this->shippingMethod;
    }

    /**
     * @param string $shippingMethod
     * @return PaymentRequest
     */
    public function setShippingMethod(string $shippingMethod) : self
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCustomerCreatedDate() : ?\DateTimeInterface
    {
        return $this->customerCreatedDate;
    }

    /**
     * @param \DateTimeInterface $customerCreatedDate
     * @return PaymentRequest
     */
    public function setCustomerCreatedDate(\DateTimeInterface $customerCreatedDate) : self
    {
        $this->customerCreatedDate = $customerCreatedDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganisationNumber() : ?string
    {
        return $this->organisationNumber;
    }

    /**
     * @param string $organisationNumber
     * @return PaymentRequest
     */
    public function setOrganisationNumber(string $organisationNumber) : self
    {
        $this->organisationNumber = $organisationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountOffer() : ?string
    {
        return $this->accountOffer;
    }

    /**
     * @param string $accountOffer
     * @return PaymentRequest
     */
    public function setAccountOffer(string $accountOffer) : self
    {
        $this->accountOffer = $accountOffer;
        return $this;
    }

    /**
     * @return CustomerInfoInterface
     */
    public function getCustomerInfo() : CustomerInfoInterface
    {
        if (!$this->customerInfo) {
            $this->customerInfo = new CustomerInfo();
        }
        return $this->customerInfo;
    }

    /**
     * @param CustomerInfoInterface $customerInfo
     * @return PaymentRequest
     */
    public function setCustomerInfo(CustomerInfoInterface $customerInfo) : self
    {
        $this->customerInfo = $customerInfo;
        return $this;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig() : ConfigInterface
    {
        if (!$this->config) {
            $this->config = new Config();
        }
        return $this->config;
    }

    /**
     * @param ConfigInterface $config
     * @return PaymentRequest
     */
    public function setConfig(ConfigInterface $config) : self
    {
        $this->config = $config;
        return $this;
    }
}
