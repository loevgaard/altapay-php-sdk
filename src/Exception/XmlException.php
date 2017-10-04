<?php
namespace Loevgaard\AltaPay\Exception;

class XmlException extends Exception
{
    /**
     * @var string
     */
    protected $xml;

    /**
     * @return string
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param string $xml
     * @return XmlException
     */
    public function setXml(string $xml) : XmlException
    {
        $this->xml = $xml;
        return $this;
    }

    public function setXmlElement(\SimpleXMLElement $element) : XmlException
    {
        $this->xml = $element->asXML();
        return $this;
    }
}
