<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;

class OrderLine extends Payload implements OrderLineInterface
{
    const GOODS_TYPE_SHIPMENT = 'shipment';
    const GOODS_TYPE_HANDLING = 'handling';
    const GOODS_TYPE_ITEM = 'item';
    const GOODS_TYPE_REFUND = 'refund';

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
     * @var float
     */
    protected $unitPrice;

    /**
     * @var float
     */
    protected $taxPercent;

    /**
     * @var float
     */
    protected $taxAmount;

    /**
     * @var string
     */
    protected $unitCode;

    /**
     * @var float
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

    public function __construct(string $description, string $itemId, float $quantity, float $unitPrice)
    {
        $this->description = $description;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }

    public function getPayload() : array
    {
        $payload = [
            'description' => $this->description,
            'itemId' => $this->itemId,
            'quantity' => $this->quantity,
            'unitPrice' => $this->unitPrice,
            'taxPercent' => $this->taxPercent,
            'taxAmount' => $this->taxAmount,
            'unitCode' => $this->unitCode,
            'discount' => $this->discount,
            'goodsType' => $this->goodsType,
            'imageUrl' => $this->imageUrl,
        ];

        $this->validate();

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->description)->string();
        Assert::that($this->itemId)->string();
        Assert::that($this->quantity)->float();
        Assert::that($this->unitPrice)->float();
        Assert::thatNullOr($this->taxPercent)->float();
        Assert::thatNullOr($this->taxAmount)->float();
        Assert::thatNullOr($this->unitCode)->string();
        Assert::thatNullOr($this->discount)->float();
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
     * @return float
     */
    public function getUnitPrice() : float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     * @return OrderLine
     */
    public function setUnitPrice(float $unitPrice) : self
    {
        $this->unitPrice = $unitPrice;
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
     * @return float
     */
    public function getTaxAmount() : ?float
    {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return OrderLine
     */
    public function setTaxAmount(float $taxAmount) : self
    {
        $this->taxAmount = $taxAmount;
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
     * @return float
     */
    public function getDiscount() : ?float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return OrderLine
     */
    public function setDiscount(float $discount) : self
    {
        $this->discount = $discount;
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
