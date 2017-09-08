<?php
namespace Loevgaard\AltaPay\Payload;

trait OrderLineArrayTrait
{
    /**
     * @var OrderLineInterface[]
     */
    private $orderLines;

    /**
     * @return OrderLineInterface[]
     */
    public function getOrderLines() : array
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine[] $orderLines
     * @return OrderLineArrayTrait
     */
    public function setOrderLines(array $orderLines)
    {
        $this->orderLines = $orderLines;
        return $this;
    }

    /**
     * @param OrderLineInterface $orderLine
     * @return OrderLineArrayTrait
     */
    public function addOrderLine(OrderLineInterface $orderLine) : self
    {
        $this->orderLines[] = $orderLine;
        return $this;
    }

    /**
     * @param OrderLineInterface $orderLine
     * @return OrderLineArrayTrait
     */
    public function removeOrderLine(OrderLineInterface $orderLine) : self
    {
        foreach ($this->orderLines as $idx => $ol) {
            if ($orderLine === $ol) {
                unset($this->orderLines[$idx]);
                break;
            }
        }
        return $this;
    }
}
