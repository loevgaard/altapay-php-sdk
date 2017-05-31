<?php

namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Exception\PayloadException;
use PHPUnit\Framework\TestCase;

final class PayloadTest extends TestCase
{
    public function testGetPayload() {
        $payload = new PayloadConcrete();
        $this->assertTrue(is_array($payload->getPayload()));
    }

    public function testAssertString() {
        new PayloadAssertString('string');
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertString(0);
    }

    public function testAssertStringOrNull() {
        new PayloadAssertStringOrNull(null);
        $this->assertTrue(true);

        new PayloadAssertStringOrNull('string');
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertStringOrNull(0);
    }

    public function testAssertNumeric() {
        new PayloadAssertNumeric(100);
        $this->assertTrue(true);

        new PayloadAssertNumeric(100.5);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertNumeric('string');
    }

    public function testAssertNumericOrNull() {
        new PayloadAssertNumericOrNull(null);
        $this->assertTrue(true);

        new PayloadAssertNumericOrNull(100);
        $this->assertTrue(true);

        new PayloadAssertNumericOrNull(100.5);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertNumericOrNull('string');
    }

    public function testAssertDateTime() {
        new PayloadAssertDateTime(new \DateTime());
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertDateTime(0);
    }

    public function testAssertDateTimeOrNull() {
        new PayloadAssertDateTimeOrNull(null);
        $this->assertTrue(true);

        new PayloadAssertDateTimeOrNull(new \DateTime());
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertDateTimeOrNull(0);
    }

    public function testAssertInArray() {
        new PayloadAssertInArray('val1', ['val1', 'val2']);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertInArray('val', ['val1', 'val2']);
    }

    public function testAssertInArrayOrNull() {
        new PayloadAssertInArrayOrNull(null, ['val1', 'val2']);
        $this->assertTrue(true);

        new PayloadAssertInArrayOrNull('val1', ['val1', 'val2']);
        $this->assertTrue(true);

        $this->expectException(PayloadException::class);

        new PayloadAssertInArrayOrNull('val', ['val1', 'val2']);
    }
}

class PayloadConcrete extends Payload {
}

class PayloadAssertString extends Payload {
    public function __construct($val)
    {
        $this->assertString($val);
    }
}

class PayloadAssertStringOrNull extends Payload {
    public function __construct($val)
    {
        $this->assertStringOrNull($val);
    }
}

class PayloadAssertNumeric extends Payload {
    public function __construct($val)
    {
        $this->assertNumeric($val);
    }
}

class PayloadAssertNumericOrNull extends Payload {
    public function __construct($val)
    {
        $this->assertNumericOrNull($val);
    }
}

class PayloadAssertDateTime extends Payload {
    public function __construct($val)
    {
        $this->assertDateTime($val);
    }
}

class PayloadAssertDateTimeOrNull extends Payload {
    public function __construct($val)
    {
        $this->assertDateTimeOrNull($val);
    }
}

class PayloadAssertInArray extends Payload {
    public function __construct($val, $arr)
    {
        $this->assertInArray($val, $arr);
    }
}

class PayloadAssertInArrayOrNull extends Payload {
    public function __construct($val, $arr)
    {
        $this->assertInArrayOrNull($val, $arr);
    }
}