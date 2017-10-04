<?php

namespace Loevgaard\AltaPay\Entity;

trait TerminalsTrait
{
    /**
     * @var Terminal[]
     */
    protected $terminals;

    /**
     * @return Terminal[]
     */
    public function getTerminals(): array
    {
        $this->initializeTerminals();

        return $this->terminals;
    }

    /**
     * @param array $terminals
     */
    public function setTerminals(array $terminals)
    {
        $this->terminals = $terminals;
    }

    /**
     * @param Terminal $terminal
     */
    public function addTerminal(Terminal $terminal)
    {
        $this->initializeTerminals();

        $this->terminals[] = $terminal;
    }

    public function hydrateTerminals(\SimpleXMLElement $xml)
    {
        if (!isset($xml->Terminals) || !isset($xml->Terminals->Terminal) || empty($xml->Terminals->Terminal)) {
            return;
        }

        $this->initializeTerminals();

        foreach ($xml->Terminals->Terminal as $terminalXml) {
            $terminal = new Terminal();
            $terminal->hydrateXml($terminalXml);
            $this->terminals[] = $terminal;
        }
    }

    private function initializeTerminals()
    {
        if (is_null($this->terminals)) {
            $this->terminals = [];
        }
    }
}
