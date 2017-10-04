<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class PaymentNatureService implements HydratableInterface
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
    public function isSupportsRefunds() : bool
    {
        return $this->supportsRefunds;
    }

    /**
     * @return bool
     */
    public function isSupportsRelease() : bool
    {
        return $this->supportsRelease;
    }

    /**
     * @return bool
     */
    public function isSupportsMultipleCaptures() : bool
    {
        return $this->supportsMultipleCaptures;
    }

    /**
     * @return bool
     */
    public function isSupportsMultipleRefunds() : bool
    {
        return $this->supportsMultipleRefunds;
    }

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if(!isset($xml->PaymentNatureService)) {
            return;
        }

        $this->name = (string)$xml->PaymentNatureService['name'];
        $this->supportsRefunds = (string)$xml->PaymentNatureService->SupportsRefunds === 'true';
        $this->supportsRelease = (string)$xml->PaymentNatureService->SupportsRelease === 'true';
        $this->supportsMultipleCaptures = (string)$xml->PaymentNatureService->SupportsMultipleCaptures === 'true';
        $this->supportsMultipleRefunds = (string)$xml->PaymentNatureService->SupportsMultipleRefunds === 'true';
    }
}
