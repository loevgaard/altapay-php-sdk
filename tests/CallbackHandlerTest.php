<?php

namespace Loevgaard\AltaPay;

use Loevgaard\AltaPay\Callback\Form;
use Loevgaard\AltaPay\Callback\Xml;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class CallbackHandlerTest extends TestCase
{
    public function testHandleCallback1()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<APIResponse version="20170228">
    <Header>
        <Date>2017-09-29T10:57:53+02:00</Date>
        <Path>API/reservationOfFixedAmount</Path>
        <ErrorCode>0</ErrorCode>
        <ErrorMessage/>
    </Header>
    <Body>
        <Result>Success</Result>
    </Body>
</APIResponse>
XML;

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $request */
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getParsedBody')->willReturn([
            'xml' => $xml
        ]);

        $handler = new CallbackHandler();
        $callback = $handler->handleCallback($request);

        $this->assertInstanceOf(Xml::class, $callback);
    }

    public function testHandleCallback2()
    {
        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $request */
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getParsedBody')->willReturn([
            'shop_orderid' => '123456',
            'amount' => '100.50',
            'currency' => '208',
            'language' => 'da',
            'embedded_window' => '0'
        ]);

        $handler = new CallbackHandler();
        $callback = $handler->handleCallback($request);

        $this->assertInstanceOf(Form::class, $callback);
    }
}
