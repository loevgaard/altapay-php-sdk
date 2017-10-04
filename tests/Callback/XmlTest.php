<?php

namespace Loevgaard\AltaPay\Callback;

use Loevgaard\AltaPay\Exception\XmlException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class XmlTest extends TestCase
{
    public function testHydrate1()
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
            'shop_orderid' => '675455',
            'currency' => '208',
            'type' => 'payment',
            'embedded_window' => '0',
            'amount' => '123.41',
            'transaction_id' => '22780221',
            'payment_id' => '9ddbf89d-40ba-4766-a01b-3c52b2ac7e2a',
            'nature' => 'CreditCard',
            'require_capture' => 'true',
            'payment_status' => 'preauth',
            'masked_credit_card' => '457193******4512',
            'blacklist_token' => '115eb77ae9e9a9bb724f268cd62f7098b53d1ec1',
            'credit_card_token' => '12754aca04922a50e53e3066b23864e9ab2f83a0',
            'status' => 'succeeded',
            'avs_code' => 'T',
            'avs_text' => 'Invalid address verification response code',
            'xml' => $xml
        ]);

        new Xml($request);

        $this->assertTrue(true);
    }

    public function testHydrate2()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<APIResponse version="20170228">
    <Header>
        <Date>2017-09-29T10:57:53+02:00invalid</Date>
        <Path>API/reservationOfFixedAmount</Path>
        <ErrorCode>0</ErrorCode>
        <ErrorMessage/>
    </Header>
</APIResponse>
XML;

        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $request */
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getParsedBody')->willReturn([
            'xml' => $xml
        ]);

        $this->expectException(XmlException::class);

        new Xml($request);
    }
}
