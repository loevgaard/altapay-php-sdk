<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class PayloadTest extends TestCase
{
    public function testGetPayload()
    {
        $stub = $this->getPayloadStub();
        $this->assertTrue(is_array($stub->getPayload()));
    }

    /**
     * @return Payload
     */
    private function getPayloadStub()
    {
        return $this->getMockForAbstractClass(Payload::class);
    }
}
