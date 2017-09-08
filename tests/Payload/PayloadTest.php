<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class PayloadTest extends TestCase
{
    public function testGetPayload()
    {
        $mock = $this->getPayloadStub();
        $this->assertTrue(is_array($mock->getPayload()));
    }

    public function testCleanPayload()
    {
        $arr = [
            'elm1' => 'val1',
            'elm2' => null,
            'elm3' => [],
            'elm4' => ['nested']
        ];

        $this->assertSame([
            'elm1' => 'val1',
            'elm4' => ['nested']
        ], Payload::simplePayload($arr));
    }

    /**
     * @return Payload|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getPayloadStub()
    {
        return $this->getMockForAbstractClass(Payload::class);
    }
}
