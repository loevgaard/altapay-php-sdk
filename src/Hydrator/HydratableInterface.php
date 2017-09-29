<?php
namespace Loevgaard\AltaPay\Hydrator;

interface HydratableInterface
{
    public function hydrateXml(\SimpleXMLElement $xml);
}