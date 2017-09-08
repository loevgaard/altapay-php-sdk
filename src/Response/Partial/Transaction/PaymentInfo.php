<?php
namespace Loevgaard\AltaPay\Response\Partial\Transaction;

use Loevgaard\AltaPay\Response\Partial\PartialResponse;

class PaymentInfo extends PartialResponse
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    protected function init()
    {
        $this->name = (string)$this->xmlDoc['name'];
        $this->value = (string)$this->xmlDoc;
    }
}
