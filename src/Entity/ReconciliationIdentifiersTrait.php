<?php

namespace Loevgaard\AltaPay\Entity;

trait ReconciliationIdentifiersTrait
{
    /**
     * @var ReconciliationIdentifier[]
     */
    protected $reconciliationIdentifiers;

    /**
     * @return ReconciliationIdentifier[]
     */
    public function getReconciliationIdentifiers(): array
    {
        $this->initializeReconciliationIdentifiers();

        return $this->reconciliationIdentifiers;
    }

    /**
     * @param array $reconciliationIdentifiers
     */
    public function setReconciliationIdentifiers(array $reconciliationIdentifiers)
    {
        $this->reconciliationIdentifiers = $reconciliationIdentifiers;
    }

    /**
     * @param ReconciliationIdentifier $reconciliationIdentifier
     */
    public function addReconciliationIdentifier(ReconciliationIdentifier $reconciliationIdentifier)
    {
        $this->initializeReconciliationIdentifiers();

        $this->reconciliationIdentifiers[] = $reconciliationIdentifier;
    }

    public function hydrateReconciliationIdentifiers(\SimpleXMLElement $xml)
    {
        if (!isset($xml->ReconciliationIdentifiers) || !isset($xml->ReconciliationIdentifiers->ReconciliationIdentifier)
            || empty($xml->ReconciliationIdentifiers->ReconciliationIdentifier)) {
            return;
        }

        $this->initializeReconciliationIdentifiers();

        foreach ($xml->ReconciliationIdentifiers->ReconciliationIdentifier as $reconciliationIdentifierXml) {
            $reconciliationIdentifier = new ReconciliationIdentifier();
            $reconciliationIdentifier->hydrateXml($reconciliationIdentifierXml);
            $this->reconciliationIdentifiers[] = $reconciliationIdentifier;
        }
    }

    private function initializeReconciliationIdentifiers()
    {
        if (is_null($this->reconciliationIdentifiers)) {
            $this->reconciliationIdentifiers = [];
        }
    }
}
