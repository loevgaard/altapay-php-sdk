<?php

namespace Loevgaard\AltaPay\Exception;

use PHPUnit\Framework\TestCase;

final class XmlExceptionTest extends TestCase
{
    public function testGettersSetters()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<APIResponse version="20110831">
</APIResponse>

XML;
        $xmlElement = new \SimpleXMLElement($xml);
        $exception = new XmlException();
        $exception->setXmlElement($xmlElement);

        $this->assertEquals($xml, $exception->getXml());

        $xml2 = '<?xml version="1.0"?><APIResponse version="20171004"></APIResponse>';
        $exception = new XmlException();
        $exception->setXml($xml2);

        $this->assertSame($xml2, $exception->getXml());
    }
}
