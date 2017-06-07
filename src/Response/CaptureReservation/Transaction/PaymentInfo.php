<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction;

use Loevgaard\AltaPay\Response\PartialResponse;

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

    protected function init()
    {
        $this->name = (string)$this->xmlDoc['name'];
        $this->value = (string)$this->xmlDoc;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
