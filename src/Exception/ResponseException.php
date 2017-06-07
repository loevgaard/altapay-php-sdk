<?php
namespace Loevgaard\AltaPay\Exception;

use Psr\Http\Message\ResponseInterface;

class ResponseException extends Exception
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return ResponseException
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
}
