<?php
namespace Loevgaard\AltaPay\Payload;

interface PayloadInterface
{
    /**
     * @return array
     */
    public function getPayload() : array;

    /**
     * Validates the payload and throws exception if not valid
     *
     * @return void
     */
    public function validate();
}
