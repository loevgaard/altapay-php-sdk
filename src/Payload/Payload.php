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
     * This method will remove null values from the input array
     *
     * @param array $payload
     * @return array
     */
    protected function cleanPayload(array $payload) : array
    {
        foreach ($payload as $k => $v) {
            if ($v === null) {
                unset($payload[$k]);
            }
        }

        return $payload;
    }
}
