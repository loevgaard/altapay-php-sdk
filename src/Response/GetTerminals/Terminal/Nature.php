<?php
namespace Loevgaard\AltaPay\Response\GetTerminals\Terminal;

use Loevgaard\AltaPay\Response\Partial\PartialResponse;

class Nature extends PartialResponse
{
    /**
     * @var string
     */
    protected $nature;

    public function __toString() : string
    {
        return (string)$this->nature;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }

    protected function init()
    {
        $this->nature = (string)$this->xmlDoc;
    }
}
