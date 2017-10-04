<?php

namespace Loevgaard\AltaPay\Callback;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class CallbackTest extends TestCase
{
    public function testHydrate1()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $request->expects($this->any())->method('getParsedBody')->willReturn([]);

        $this->getMockForAbstractClass(Callback::class, [$request]);

        $this->assertTrue(true);
    }
}
