<?php

namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Exception\PayloadException;
use PHPUnit\Framework\TestCase;

final class PayloadTest extends TestCase
{
    public function testGetPayload()
    {
        $stub = $this->getPayloadStub();
        $this->assertTrue(is_array($stub->getPayload()));
    }

    public function testAssertString()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertString', ['string']);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertString', [0]);
    }

    public function testAssertStringOrNull()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertStringOrNull', [null]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertStringOrNull', ['string']);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertStringOrNull', [0]);
    }

    public function testAssertNumeric()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertNumeric', [100]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertNumeric', [100.5]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertNumeric', ['string']);
    }

    public function testAssertNumericOrNull()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertNumericOrNull', [null]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertNumericOrNull', [100]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertNumericOrNull', [100.5]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertNumericOrNull', ['string']);
    }

    public function testAssertDateTime()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertDateTime', [new \DateTime()]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertDateTime', [0]);
    }

    public function testAssertDateTimeOrNull()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertDateTimeOrNull', [null]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertDateTimeOrNull', [new \DateTime()]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertDateTimeOrNull', [0]);
    }

    public function testAssertInArray()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertInArray', ['val1', ['val1', 'val2']]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertInArray', ['val', ['val1', 'val2']]);
    }

    public function testAssertInArrayOrNull()
    {
        $stub = $this->getPayloadStub();
        $this->invokeMethod($stub, 'assertInArrayOrNull', [null, ['val1', 'val2']]);
        $this->assertTrue(true);

        $this->invokeMethod($stub, 'assertInArrayOrNull', ['val1', ['val1', 'val2']]);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        $this->invokeMethod($stub, 'assertInArrayOrNull', ['val', ['val1', 'val2']]);
    }

    /**
     * Helper methods
     */

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    private function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @return Payload
     */
    private function getPayloadStub()
    {
        return $this->getMockForAbstractClass(Payload::class);
    }
}
