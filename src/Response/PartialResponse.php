<?php
namespace Loevgaard\AltaPay\Response;

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

    protected function init() {

    }

    /**
     * @return PsrResponseInterface
     */
    public function getOriginalResponse()
    {
        return $this->originalResponse;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXmlDoc()
    {
        return $this->xmlDoc;
    }
}