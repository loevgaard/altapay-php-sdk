<?php
namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Payload\PaymentRequest\Config;
use Loevgaard\AltaPay\Payload\PaymentRequest\ConfigInterface;
use Loevgaard\AltaPay\Payload\PaymentRequest\CustomerInfo;
use Loevgaard\AltaPay\Payload\PaymentRequest\CustomerInfoInterface;
use Loevgaard\AltaPay\Payload\PaymentRequest\OrderLineInterface;

class PaymentRequest extends Payload implements PaymentRequestInterface
{
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
     * @var string
     */
    private $cookie;

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
     * @var string
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
     * @var OrderLineInterface[]
     */
    private $orderLines;

    /**
     * @var CustomerInfoInterface
     */
    private $customerInfo;

    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct()
    {
        $this->orderLines = [];
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        $payload = [
            'terminal' => $this->terminal,
            'shop_order_id' => $this->shopOrderId,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'language' => $this->language,
            'transaction_info' => $this->transactionInfo,
            'type' => $this->type,
            'ccToken' => $this->ccToken,
            'sale_reconciliation_identifier' => $this->saleReconciliationIdentifier,
            'sale_invoice_number' => $this->saleInvoiceNumber,
            'sales_tax' => $this->salesTax,
            'cookie' => $this->cookie,
            'payment_source' => $this->paymentSource,
            'fraud_service' => $this->fraudService,
            'shipping_method' => $this->shippingMethod,
            'customer_created_date' => $this->customerCreatedDate,
            'organisation_number' => $this->organisationNumber,
            'account_offer' => $this->accountOffer,
        ];

        // set config payload if any
        $config = $this->getConfig()->getPayload();
        if(!empty($config)) {
            $payload['config'] = $config;
        }

        // set customer info payload if any
        $customerInfo = $this->getCustomerInfo()->getPayload();
        if(!empty($customerInfo)) {
            $payload['customer_info'] = $customerInfo;
        }

        // create order lines array
        $orderLines = [];
        foreach ($this->orderLines as $orderLine) {
            $orderLines[] = $orderLine->getPayload();
        }

        if(!empty($orderLines)) {
            $payload['orderLines'] = $orderLines;
        }

        return $this->cleanPayload($payload);
    }

    /**
     * @param OrderLineInterface $orderLine
     * @return PaymentRequest
     */
    public function addOrderLine(OrderLineInterface $orderLine) {
        $this->orderLines[] = $orderLine;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param string $terminal
     * @return PaymentRequest
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopOrderId()
    {
        return $this->shopOrderId;
    }

    /**
     * @param string $shopOrderId
     * @return PaymentRequest
     */
    public function setShopOrderId($shopOrderId)
    {
        $this->shopOrderId = $shopOrderId;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return PaymentRequest
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return PaymentRequest
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return PaymentRequest
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return array
     */
    public function getTransactionInfo()
    {
        return $this->transactionInfo;
    }

    /**
     * @param array $transactionInfo
     * @return PaymentRequest
     */
    public function setTransactionInfo($transactionInfo)
    {
        $this->transactionInfo = $transactionInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return PaymentRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getCcToken()
    {
        return $this->ccToken;
    }

    /**
     * @param string $ccToken
     * @return PaymentRequest
     */
    public function setCcToken($ccToken)
    {
        $this->ccToken = $ccToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleReconciliationIdentifier()
    {
        return $this->saleReconciliationIdentifier;
    }

    /**
     * @param string $saleReconciliationIdentifier
     * @return PaymentRequest
     */
    public function setSaleReconciliationIdentifier($saleReconciliationIdentifier)
    {
        $this->saleReconciliationIdentifier = $saleReconciliationIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaleInvoiceNumber()
    {
        return $this->saleInvoiceNumber;
    }

    /**
     * @param string $saleInvoiceNumber
     * @return PaymentRequest
     */
    public function setSaleInvoiceNumber($saleInvoiceNumber)
    {
        $this->saleInvoiceNumber = $saleInvoiceNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalesTax()
    {
        return $this->salesTax;
    }

    /**
     * @param float $salesTax
     * @return PaymentRequest
     */
    public function setSalesTax($salesTax)
    {
        $this->salesTax = $salesTax;
        return $this;
    }

    /**
     * @return string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param string $cookie
     * @return PaymentRequest
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentSource()
    {
        return $this->paymentSource;
    }

    /**
     * @param string $paymentSource
     * @return PaymentRequest
     */
    public function setPaymentSource($paymentSource)
    {
        $this->paymentSource = $paymentSource;
        return $this;
    }

    /**
     * @return string
     */
    public function getFraudService()
    {
        return $this->fraudService;
    }

    /**
     * @param string $fraudService
     * @return PaymentRequest
     */
    public function setFraudService($fraudService)
    {
        $this->fraudService = $fraudService;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * @param string $shippingMethod
     * @return PaymentRequest
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCreatedDate()
    {
        return $this->customerCreatedDate;
    }

    /**
     * @param string $customerCreatedDate
     * @return PaymentRequest
     */
    public function setCustomerCreatedDate($customerCreatedDate)
    {
        $this->customerCreatedDate = $customerCreatedDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganisationNumber()
    {
        return $this->organisationNumber;
    }

    /**
     * @param string $organisationNumber
     * @return PaymentRequest
     */
    public function setOrganisationNumber($organisationNumber)
    {
        $this->organisationNumber = $organisationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountOffer()
    {
        return $this->accountOffer;
    }

    /**
     * @param string $accountOffer
     * @return PaymentRequest
     */
    public function setAccountOffer($accountOffer)
    {
        $this->accountOffer = $accountOffer;
        return $this;
    }

    /**
     * @return OrderLineInterface[]
     */
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLineInterface[] $orderLines
     * @return PaymentRequest
     */
    public function setOrderLines($orderLines)
    {
        $this->orderLines = $orderLines;
        return $this;
    }

    /**
     * @return CustomerInfoInterface
     */
    public function getCustomerInfo()
    {
        if(!$this->customerInfo) {
            $this->customerInfo = new CustomerInfo();
        }
        return $this->customerInfo;
    }

    /**
     * @param CustomerInfoInterface $customerInfo
     * @return PaymentRequest
     */
    public function setCustomerInfo($customerInfo)
    {
        $this->customerInfo = $customerInfo;
        return $this;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        if(!$this->config) {
            $this->config = new Config();
        }
        return $this->config;
    }

    /**
     * @param ConfigInterface $config
     * @return PaymentRequest
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }
}