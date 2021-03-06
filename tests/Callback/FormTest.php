<?php

namespace Loevgaard\AltaPay\Callback;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class FormTest extends TestCase
{
    public function testHydrate1()
    {
        $request = $this->getRequest([
            'shop_orderid' => '123456',
            'amount' => '100.50',
            'currency' => '208',
            'language' => 'da',
            'embedded_window' => '0'
        ]);

        $form = new Form($request);

        $this->assertSame('123456', $form->getShopOrderId());
        $this->assertEquals(new Money(10050, new \Money\Currency('DKK')), $form->getAmount());
        $this->assertSame(208, $form->getCurrency());
        $this->assertSame('da', $form->getLanguage());
        $this->assertFalse(false, $form->isEmbeddedWindow());
    }

    public function testInitable1()
    {
        $request = $this->getRequest([
            'shop_orderid' => '123456',
            'amount' => '100.50',
            'currency' => '208',
            'language' => 'da',
            'embedded_window' => '0'
        ]);

        $this->assertTrue(Form::initable($request));
    }

    public function testInitable2()
    {
        $request = $this->getRequest(['notvalid' => 'da']);

        $this->assertFalse(Form::initable($request));
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
