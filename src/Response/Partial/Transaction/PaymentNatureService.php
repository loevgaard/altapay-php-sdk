<?php
namespace Loevgaard\AltaPay\Response\Partial\Transaction;

use Loevgaard\AltaPay\Response\Partial\PartialResponse;

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

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getSupportsRefunds() : bool
    {
        return $this->supportsRefunds;
    }

    /**
     * @return bool
     */
    public function getSupportsRelease() : bool
    {
        return $this->supportsRelease;
    }

    /**
     * @return bool
     */
    public function getSupportsMultipleCaptures() : bool
    {
        return $this->supportsMultipleCaptures;
    }

    /**
     * @return bool
     */
    public function getSupportsMultipleRefunds() : bool
    {
        return $this->supportsMultipleRefunds;
    }

    protected function init()
    {
        $this->name = (string)$this->xmlDoc['name'];
        $this->supportsRefunds = (string)$this->xmlDoc->SupportsRefunds === 'true';
        $this->supportsRelease = (string)$this->xmlDoc->SupportsRelease === 'true';
        $this->supportsMultipleCaptures = (string)$this->xmlDoc->SupportsMultipleCaptures === 'true';
        $this->supportsMultipleRefunds = (string)$this->xmlDoc->SupportsMultipleRefunds === 'true';
    }
}
