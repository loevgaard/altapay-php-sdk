<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Response\GetTerminals\Terminal;

class GetTerminals extends Response
{
    /**
     * @var string
     */
    protected $result;

    /**
     * @var Terminal[]
     */
    protected $terminals;

    protected function init()
    {
        $this->terminals = [];
        $this->result = (string)$this->xmlDoc->Body->Result;

        if (isset($this->xmlDoc->Body->Terminals) &&
            isset($this->xmlDoc->Body->Terminals->Terminal) &&
            !empty($this->xmlDoc->Body->Terminals->Terminal)) {
            foreach ($this->xmlDoc->Body->Terminals->Terminal as $terminalXml) {
                $this->terminals[] = new Terminal($this->getResponse(), $terminalXml);
            }
        }
    }

    /**
     * @return string
     */
    public function getResult() : string
    {
        return $this->result;
    }

    /**
     * @return Terminal[]
     */
    public function getTerminals() : array
    {
        return $this->terminals;
    }
}
