<?php

namespace Loevgaard\AltaPay\Callback;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class RedirectTest extends TestCase
{
    public function testHydrate1()
    {
        $request = $this->getRequest(['language' => 'da']);

        $form = new Redirect($request);

        $this->assertSame('da', $form->getLanguage());
    }

    public function testInitable1()
    {
        $request = $this->getRequest(['language' => 'da']);

        $this->assertTrue(Redirect::initable($request));
    }

    public function testInitable2()
    {
        $request = $this->getRequest(['notvalid' => 'da']);

        $this->assertFalse(Redirect::initable($request));
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
