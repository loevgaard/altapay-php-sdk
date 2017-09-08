<?php
namespace Loevgaard\AltaPay\Response\Partial;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

abstract class PartialResponse implements PartialResponseInterface
{
    /**
     * Holds the original response object
     *
     * @var PsrResponseInterface
     */
    protected $originalResponse;

    /**
     * Holds an XML object
     *
     * @var \SimpleXMLElement
     */
    protected $xmlDoc;

    /**
     * @param PsrResponseInterface $originalResponse
     * @param \SimpleXMLElement $xmlDoc
     */
    public function __construct(PsrResponseInterface $originalResponse, \SimpleXMLElement $xmlDoc)
    {
        $this->originalResponse = $originalResponse;
        $this->xmlDoc = $xmlDoc;
        $this->init();
    }

    /**
     * @return PsrResponseInterface
     */
    public function getOriginalResponse() : PsrResponseInterface
    {
        return $this->originalResponse;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXmlDoc() : \SimpleXMLElement
    {
        return $this->xmlDoc;
    }

    /**
     * Is called after the contructor has initialized the properties
     * Use this to do any initialization you need
     */
    protected function init()
    {
    }
}
