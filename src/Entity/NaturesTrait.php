<?php

namespace Loevgaard\AltaPay\Entity;

trait NaturesTrait
{
    /**
     * @var Nature[]
     */
    protected $natures;

    /**
     * @return Nature[]
     */
    public function getNatures(): array
    {
        $this->initializeNatures();

        return $this->natures;
    }

    /**
     * @param array $natures
     */
    public function setNatures(array $natures)
    {
        $this->natures = $natures;
    }

    /**
     * @param Nature $nature
     */
    public function addNature(Nature $nature)
    {
        $this->initializeNatures();

        $this->natures[] = $nature;
    }

    public function hydrateNatures(\SimpleXMLElement $xml)
    {
        if (!isset($xml->Natures) || !isset($xml->Natures->Nature) || empty($xml->Natures->Nature)) {
            return;
        }

        $this->initializeNatures();

        foreach ($xml->Natures->Nature as $currencyXml) {
            $nature = new Nature();
            $nature->hydrateXml($currencyXml);
            $this->natures[] = $nature;
        }
    }

    private function initializeNatures()
    {
        if (is_null($this->natures)) {
            $this->natures = [];
        }
    }
}
