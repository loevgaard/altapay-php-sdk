<?php

namespace Loevgaard\AltaPay\Entity;

trait CustomerInfoTrait
{
    /**
     * @var CustomerInfo
     */
    private $customerInfo;


    public function hydrateCustomerInfo(\SimpleXMLElement $xml)
    {
        $customerInfo = new CustomerInfo();
        $customerInfo->hydrateXml($xml);

        $this->customerInfo = $customerInfo;
    }

    /**
     * @return CustomerInfo
     */
    public function getCustomerInfo() : CustomerInfo
    {
        return $this->customerInfo;
    }
}
