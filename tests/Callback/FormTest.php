<?php

namespace Loevgaard\AltaPay\Callback;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class FormTest extends TestCase
{
    public function testHydrate1()
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

        $form = new Form($request);

        $this->assertSame('123456', $form->getShopOrderId());
        $this->assertSame(100.5, $form->getAmount());
        $this->assertSame(208, $form->getCurrency());
        $this->assertSame('da', $form->getLanguage());
        $this->assertFalse(false, $form->isEmbeddedWindow());
    }
}
