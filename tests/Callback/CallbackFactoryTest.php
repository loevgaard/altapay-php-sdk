<?php

namespace Loevgaard\AltaPay\Callback;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class CallbackFactoryTest extends TestCase
{
    public function testCreate1()
    {
        $request = $this->getRequest([
            'shop_orderid' => '123456',
            'amount' => '100.50',
            'currency' => '208',
            'language' => 'da',
            'embedded_window' => '0'
        ]);
        $factory = new CallbackFactory();
        $callback = $factory->create($request);

        $this->assertInstanceOf(Form::class, $callback);
    }

    public function testCreate2()
    {
        $request = $this->getRequest([
            'language' => 'da',
        ]);
        $factory = new CallbackFactory();
        $callback = $factory->create($request);

        $this->assertInstanceOf(Redirect::class, $callback);
    }

    public function testCreate3()
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

        $request = $this->getRequest([
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

        $factory = new CallbackFactory();
        $callback = $factory->create($request);

        $this->assertInstanceOf(Xml::class, $callback);
    }

    public function testCreateExpectException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $request = $this->getRequest([
            'notvalid' => 'da',
        ]);
        $factory = new CallbackFactory();
        $factory->create($request);
    }

    /**
     * @param array $val
     * @return \PHPUnit_Framework_MockObject_MockObject|ServerRequestInterface
     */
    private function getRequest(array $val)
    {
        /** @var ServerRequestInterface|\PHPUnit_Framework_MockObject_MockObject $request */
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getParsedBody')->willReturn($val);

        return $request;
    }
}
