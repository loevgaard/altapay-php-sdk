<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use Loevgaard\AltaPay\Payload\Payload;

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

    public function __construct($description, $itemId, $quantity, $unitPrice, $taxPercent = null, $taxAmount = null, $unitCode = null, $discount = null, $goodsType = null, $imageUrl = null)
    {
        $this->setDescription($description);
        $this->setItemId($itemId);
        $this->setQuantity($quantity);
        $this->setUnitPrice($unitPrice);
        $this->setTaxPercent($taxPercent);
        $this->setTaxAmount($taxAmount);
        $this->setUnitCode($unitCode);
        $this->setDiscount($discount);
        $this->setGoodsType($goodsType);
        $this->setImageUrl($imageUrl);
    }

    public function getPayload()
    {
        $payload = [
            'description' => $this->getDescription(),
            'itemId' => $this->getItemId(),
            'quantity' => $this->getQuantity(),
            'unitPrice' => $this->getUnitPrice(),
            'taxPercent' => $this->getTaxPercent(),
            'taxAmount' => $this->getTaxAmount(),
            'unitCode' => $this->getUnitCode(),
            'discount' => $this->getDiscount(),
            'goodsType' => $this->getGoodsType(),
            'imageUrl' => $this->getImageUrl(),
        ];

        return $this->cleanPayload($payload);
    }

    /**
     * @return array
     */
    public static function getGoodsTypes() {
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return OrderLine
     */
    public function setDescription($description)
    {
        $this->assertString($description);
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param string $itemId
     * @return OrderLine
     */
    public function setItemId($itemId)
    {
        $this->assertString($itemId);
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return OrderLine
     */
    public function setQuantity($quantity)
    {
        $this->assertNumeric($quantity);
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     * @return OrderLine
     */
    public function setUnitPrice($unitPrice)
    {
        $this->assertNumeric($unitPrice);
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    /**
     * @param float $taxPercent
     * @return OrderLine
     */
    public function setTaxPercent($taxPercent)
    {
        $this->assertNumericOrNull($taxPercent);
        $this->taxPercent = $taxPercent;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    /**
     * @param float $taxAmount
     * @return OrderLine
     */
    public function setTaxAmount($taxAmount)
    {
        $this->assertNumericOrNull($taxAmount);
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitCode()
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     * @return OrderLine
     */
    public function setUnitCode($unitCode)
    {
        $this->assertStringOrNull($unitCode);
        $this->unitCode = $unitCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return OrderLine
     */
    public function setDiscount($discount)
    {
        $this->assertNumericOrNull($discount);
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return string
     */
    public function getGoodsType()
    {
        return $this->goodsType;
    }

    /**
     * @param string $goodsType
     * @return OrderLine
     */
    public function setGoodsType($goodsType)
    {
        $this->assertInArrayOrNull($goodsType, self::getGoodsTypes());
        $this->goodsType = $goodsType;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return OrderLine
     */
    public function setImageUrl($imageUrl)
    {
        $this->assertStringOrNull($imageUrl);
        $this->imageUrl = $imageUrl;
        return $this;
    }
}