<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Entity\ResultTrait;
use Loevgaard\AltaPay\Entity\TerminalsTrait;

class GetTerminals extends Response
{
    use TerminalsTrait;
    use ResultTrait;

    protected function init()
    {
        /** @var \SimpleXMLElement $body */
        $body = $this->xmlDoc->Body;
        $this->hydrateTerminals($body);
    }
}
