<?php
namespace Loevgaard\AltaPay\Payload;

interface PayloadInterface
{
    /**
     * @return array
     */
    public function getPayload();
}