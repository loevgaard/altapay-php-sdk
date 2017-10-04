<?php

namespace Loevgaard\AltaPay\Callback;

use Loevgaard\AltaPay\Entity\ResultTrait;
use Loevgaard\AltaPay\Entity\TransactionsTrait;
use Loevgaard\AltaPay\Exception\XmlException;

class Xml extends Callback
{
    use ResultTrait;
    use TransactionsTrait;

    /**
     * @var string
     */
    protected $xml;

    /**
     * Holds an XML object based on the Xml::$xml string
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

    public function init()
    {
        $this->xml = $this->body['xml'];
        $this->xmlDoc = new \SimpleXMLElement($this->xml);
        $this->version = (string)$this->xmlDoc['version'];
        $this->date = \DateTimeImmutable::createFromFormat(DATE_RFC3339, (string)$this->xmlDoc->Header->Date);
        if ($this->date === false) {
            $exception = new XmlException('The date format is wrong in xml header');
            $exception->setXmlElement($this->xmlDoc);
            throw $exception;
        }
        $this->path = (string)$this->xmlDoc->Header->Path;
        $this->errorCode = (int)$this->xmlDoc->Header->ErrorCode;
        $this->errorMessage = (string)$this->xmlDoc->Header->ErrorMessage;

        /** @var \SimpleXMLElement $body */
        $body = $this->xmlDoc->Body;

        $this->hydrateTransactions($body);
    }
}