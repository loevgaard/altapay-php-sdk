<?php
namespace Loevgaard\AltaPay\Response;

interface ResponseInterface
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse() : \Psr\Http\Message\ResponseInterface;
}
