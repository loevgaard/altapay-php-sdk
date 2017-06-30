<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Exception\ResponseException;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

abstract class Response implements ResponseInterface
{
    /**
     * Holds the response object
     *
     * @var PsrResponseInterface
     */
    protected $response;

    /**
     * Holds the entire XML response string, i.e.
     *
     * <APIResponse version="20110831">
     *   <Header>
     *     <Date>2011-08-29T23:48:32+02:00</Date>
     *     <Path>API/xxx</Path>
     *     <ErrorCode>0</ErrorCode>
     *     <ErrorMessage/>
     *   </Header>
     *   <Body>
     *     [.....]
     *   </Body>
     * </APIResponse>
     *
     * @var string
     */
    protected $xml;

    /**
     * Holds an XML object based on the Response::$xml string
     *
     * @var \SimpleXMLElement
     */
    protected $xmlDoc;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var \DateTimeImmutable
     */
    protected $date;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * @param PsrResponseInterface $response
     * @throws ResponseException
     */
    public function __construct(PsrResponseInterface $response)
    {
        $this->response = $response;
        $this->xml = (string)$this->response->getBody();
        $this->xmlDoc = new \SimpleXMLElement($this->xml);
        $this->version = (string)$this->xmlDoc['version'];
        $this->date = \DateTimeImmutable::createFromFormat(DATE_RFC3339, (string)$this->xmlDoc->Header->Date);
        if ($this->date === false) {
            $exception = new ResponseException('The date format is wrong in xml header');
            $exception->setResponse($this->response);
            throw $exception;
        }
        $this->path = (string)$this->xmlDoc->Header->Path;
        $this->errorCode = (int)$this->xmlDoc->Header->ErrorCode;
        $this->errorMessage = (string)$this->xmlDoc->Header->ErrorMessage;
        $this->init();
    }

    /**
     * Is called after the contructor has initialized the properties
     * Use this to do any initialization you need
     */
    protected function init()
    {
    }

    /**
     * @return bool
     */
    public function isSuccessful() : bool
    {
        return $this->errorCode === 0;
    }

    /**
     * @return PsrResponseInterface
     */
    public function getResponse() : PsrResponseInterface
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getXml() : string
    {
        return $this->xml;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXmlDoc() : \SimpleXMLElement
    {
        return $this->xmlDoc;
    }

    /**
     * @return string
     */
    public function getVersion() : string
    {
        return $this->version;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate() : \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getErrorCode() : int
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage() : string
    {
        return $this->errorMessage;
    }
}
