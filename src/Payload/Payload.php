<?php
namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Exception\PayloadException;

abstract class Payload implements PayloadInterface
{
    /**
     * @inheritdoc
     */
    public function getPayload()
    {
        return [];
    }

    /**
     * This method will remove null values from the input array
     *
     * @param array $payload
     * @return array
     */
    protected function cleanPayload(array $payload)
    {
        foreach ($payload as $k => $v) {
            if ($v === null) {
                unset($payload[$k]);
            }
        }

        return $payload;
    }

    final protected function assertString($val)
    {
        if (is_string($val)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected string');
    }

    final protected function assertStringOrNull($val)
    {
        if (is_null($val) || is_string($val)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected null or string');
    }

    final protected function assertNumeric($val)
    {
        if (is_int($val) || is_float($val)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected int or float');
    }

    final protected function assertNumericOrNull($val)
    {
        if (is_null($val) || is_float($val) || is_int($val)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected null, float or int');
    }

    final protected function assertInArray($val, $arr)
    {
        if (in_array($val, $arr)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected value to be in array ['.join(', ', $arr).']');
    }

    final protected function assertInArrayOrNull($val, $arr)
    {
        if (is_null($val) || in_array($val, $arr)) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected null or value to be in array ['.join(', ', $arr).']');
    }

    final protected function assertDateTime($val)
    {
        if ($val instanceof \DateTimeInterface) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected \DateTimeInterface');
    }

    final protected function assertDateTimeOrNull($val)
    {
        if (is_null($val) || $val instanceof \DateTimeInterface) {
            return true;
        }

        throw $this->createAssertionException($val, 'Expected null or \DateTimeInterface');
    }

    /**
     * @param $val
     * @param string $expected
     * @return PayloadException
     */
    protected function createAssertionException($val, $expected)
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);

        return new PayloadException(trim($expected, '.'));

        /*
         * @todo make it better for debugging. Remember to check if indices are set in $backtrace
        return new PayloadException(
            trim($expected, '.').
            '. Value given ('.gettype($val).') '.$val.'. Called in '.$backtrace[1]['file'].
            ' on line '.$backtrace[1]['line'].' with arguments: ['.json_encode($backtrace[1]['args']).']'
        );
        */
    }
}
