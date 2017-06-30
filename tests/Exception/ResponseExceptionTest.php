<?php

namespace Loevgaard\AltaPay\Exception;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ResponseExceptionTest extends TestCase
{
    public function testGettersSetters()
    {
        $response = new Response();
        $exception = new ResponseException();
        $exception->setResponse($response);

        $this->assertEquals($response, $exception->getResponse());
    }
}
