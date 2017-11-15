<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;
use Loevgaard\AltaPay;
use Money\Money;

class OrderLine extends Payload implements OrderLineInterface
{
    const GOODS_TYPE_SHIPMENT = 'shipment';
    const GOODS_TYPE_HANDLING = 'handling';
    const GOODS_TYPE_ITEM = 'item';
    const GOODS_TYPE_REFUND = 'refund';

    /**
     * Used to create Money objects
     *
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $itemId;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $unitPrice;

    /**
     * @var float
     */
    protected $taxPercent;

    /**
     * @var int
     */
    protected $taxAmount;

    /**
     * @var string
     */
    protected $unitCode;

    /**
     * @var int
     */
    protected $discount;

    /**
     * @var string
     */
    protected $goodsType;

    /**
     * @var string
     */
    protected $imageUrl;

    public function __construct(string $description, string $itemId, float $quantity, Money $unitPrice)
    {
        $this->currency = $unitPrice->getCurrency()->getCode();

        $this->setDescription($description);
        $this->setItemId($itemId);
        $this->setQuantity($quantity);
        $this->setUnitPrice($unitPrice);
    }

    public function getPayload() : array
    {
        $this->validate();

        $payload = [
            'description' => $this->description,
            'itemId' => $this->itemId,
            'quantity' => $this->quantity,
            'unitPrice' => AltaPay\floatFromMoney($this->getUnitPrice()),
            'taxPercent' => $this->taxPercent,
            'taxAmount' => AltaPay\floatFromMoney($this->getTaxAmount()),
            'unitCode' => $this->unitCode,
            'discount' => AltaPay\floatFromMoney($this->getDiscount()),
            'goodsType' => $this->goodsType,
            'imageUrl' => $this->imageUrl,
        ];

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->description)->string();
        Assert::that($this->itemId)->string();
        Assert::that($this->quantity)->float();
        Assert::that($this->getUnitPrice())->isInstanceOf(Money::class);
        Assert::thatNullOr($this->taxPercent)->float();
        Assert::thatNullOr($this->getTaxAmount())->isInstanceOf(Money::class);
        Assert::thatNullOr($this->unitCode)->string();
        Assert::thatNullOr($this->getDiscount())->isInstanceOf(Money::class);
        Assert::thatNullOr($this->goodsType)->string()->inArray(static::getGoodsTypes());
        Assert::thatNullOr($this->imageUrl)->string();
    }

    /**
     * @return array
     */
    public static function getGoodsTypes() : array
    {
        return [
            self::GOODS_TYPE_HANDLING,
            self::GOODS_TYPE_ITEM,
            self::GOODS_TYPE_REFUND,
            self::GOODS_TYPE_SHIPMENT,
        ];
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return OrderLine
     */
    public function setDescription(string $description) : self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId() : string
    {
        return $this->itemId;
    }

    /**
     * @param string $itemId
     * @return OrderLine
     */
    public function setItemId(string $itemId) : self
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity() : float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return OrderLine
     */
    public function setQuantity(float $quantity) : self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return Money
     */
    public function getUnitPrice() : ?Money
    {
        return AltaPay\createMoney((string)$this->currency, (int)$this->unitPrice);
    }

    /**
     * @param Money $unitPrice
     * @return OrderLine
     */
    public function setUnitPrice(Money $unitPrice) : self
    {
        if ($unitPrice->getCurrency()->getCode() !== $this->currency) {
            throw new \InvalidArgumentException('The $unitPrice does not have the same currency as this order line');
        }

        $this->unitPrice = $unitPrice->getAmount();
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxPercent() : ?float
    {
        return $this->taxPercent;
    }

    /**
     * @param float $taxPercent
     * @return OrderLine
     */
    public function setTaxPercent(float $taxPercent) : self
    {
        $this->taxPercent = $taxPercent;
        return $this;
    }

    /**
     * @return Money
     */
    public function getTaxAmount() : ?Money
    {
        if (is_null($this->taxAmount)) {
            return null;
        }

        return AltaPay\createMoney((string)$this->currency, (int)$this->taxAmount);
    }

    /**
     * @param Money $taxAmount
     * @return OrderLine
     */
    public function setTaxAmount(Money $taxAmount) : self
    {
        if ($taxAmount->getCurrency()->getCode() !== $this->currency) {
            throw new \InvalidArgumentException('The $taxAmount does not have the same currency as this order line');
        }

        $this->taxAmount = $taxAmount->getAmount();
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitCode() : ?string
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     * @return OrderLine
     */
    public function setUnitCode(string $unitCode) : self
    {
        $this->unitCode = $unitCode;
        return $this;
    }

    /**
     * @return Money
     */
    public function getDiscount() : ?Money
    {
        if (is_null($this->discount)) {
            return null;
        }

        return AltaPay\createMoney((string)$this->currency, (int)$this->discount);
    }

    /**
     * @param Money $discount
     * @return OrderLine
     */
    public function setDiscount(Money $discount) : self
    {
        if ($discount->getCurrency()->getCode() !== $this->currency) {
            throw new \InvalidArgumentException('The $discount does not have the same currency as this order line');
        }

        $this->discount = $discount->getAmount();
        return $this;
    }

    /**
     * @return string
     */
    public function getGoodsType() : ?string
    {
        return $this->goodsType;
    }

    /**
     * @param string $goodsType
     * @return OrderLine
     */
    public function setGoodsType(string $goodsType) : self
    {
        $this->goodsType = $goodsType;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl() : ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return OrderLine
     */
    public function setImageUrl(string $imageUrl) : self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }
}
