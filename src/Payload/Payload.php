<?php
namespace Loevgaard\AltaPay\Payload;

abstract class Payload implements PayloadInterface
{
    /**
     * @inheritdoc
     */
    public function getPayload(): array
    {
        return [];
    }

    /**
     * If the input array contains objects of PayloadInterface it will convert these to simple arrays
     * Also it will remove values that are null or empty arrays
     *
     * @param array $payload
     * @return array
     */
    public static function simplePayload(array $payload) : array
    {
        $payload = array_filter($payload, function ($val) {
            // this will effectively remove empty arrays
            if (is_array($val) && empty($val)) {
                return false;
            }

            return !is_null($val);
        });

        foreach ($payload as $key => $val) {
            if (is_array($val)) {
                $payload[$key] = static::simplePayload($val);
            } elseif ($val instanceof PayloadInterface) {
                $payload[$key] = static::simplePayload($val->getPayload());
            }
        }

        return $payload;
    }
}
