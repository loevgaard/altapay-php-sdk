<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction;

use Loevgaard\AltaPay\Response\PartialResponse;

class PaymentNatureService extends PartialResponse
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $supportsRefunds;

    /**
     * @var boolean
     */
    private $supportsRelease;

    /**
     * @var boolean
     */
    private $supportsMultipleCaptures;

    /**
     * @var boolean
     */
    private $supportsMultipleRefunds;

    protected function init()
    {
        $this->name = (string)$this->xmlDoc['name'];
        $this->supportsRefunds = (string)$this->xmlDoc->SupportsRefunds === 'true';
        $this->supportsRelease = (string)$this->xmlDoc->SupportsRelease === 'true';
        $this->supportsMultipleCaptures = (string)$this->xmlDoc->SupportsMultipleCaptures === 'true';
        $this->supportsMultipleRefunds = (string)$this->xmlDoc->SupportsMultipleRefunds === 'true';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getSupportsRefunds()
    {
        return $this->supportsRefunds;
    }

    /**
     * @return bool
     */
    public function getSupportsRelease()
    {
        return $this->supportsRelease;
    }

    /**
     * @return bool
     */
    public function getSupportsMultipleCaptures()
    {
        return $this->supportsMultipleCaptures;
    }

    /**
     * @return bool
     */
    public function getSupportsMultipleRefunds()
    {
        return $this->supportsMultipleRefunds;
    }
}
