<?php

namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Exception\ResponseException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class ResponseTest extends TestCase
{
    public function testGetters()
    {
        $xml = <<<XML
<APIResponse version="20110831">
    <Header>
        <Date>2011-08-29T23:48:32+02:00</Date>
        <Path>API/xxx</Path>
        <ErrorCode>0</ErrorCode>
        <ErrorMessage/>
    </Header>
    <Body>
    
    </Body>
</APIResponse>
XML;

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        /** @var Response $responseConcrete */
        $responseConcrete = $this->getMockForAbstractClass(Response::class, [$response]);

        $this->assertInstanceOf(PsrResponseInterface::class, $responseConcrete->getResponse());
        $this->assertTrue(is_string($responseConcrete->getXml()));
        $this->assertInstanceOf(\DateTimeInterface::class, $responseConcrete->getDate());
        $this->assertEquals(0, $responseConcrete->getErrorCode());
        $responseConcrete->getErrorMessage();
        $this->assertEquals('API/xxx', $responseConcrete->getPath());
        $this->assertEquals('20110831', $responseConcrete->getVersion());
        $this->assertInstanceOf(\SimpleXMLElement::class, $responseConcrete->getXmlDoc());
    }

    public function testWrongDate()
    {
        $xml = <<<XML
<APIResponse version="20110831">
    <Header>
        <Date>wrong date</Date>
        <Path>API/xxx</Path>
        <ErrorCode>0</ErrorCode>
        <ErrorMessage/>
    </Header>
    <Body></Body>
</APIResponse>
XML;

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $this->expectException(ResponseException::class);

        $this->getMockForAbstractClass(Response::class, [$response]);
    }
}
