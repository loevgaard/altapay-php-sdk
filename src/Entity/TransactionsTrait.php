<?php

namespace Loevgaard\AltaPay\Entity;

trait TransactionsTrait
{
    /**
     * @var Transaction[]
     */
    protected $transactions;

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array
    {
        $this->initializeTransactions();

        return $this->transactions;
    }

    /**
     * @param array $transactions
     */
    public function setTransactions(array $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @param Transaction $transaction
     */
    public function addTerminal(Transaction $transaction)
    {
        $this->initializeTransactions();

        $this->transactions[] = $transaction;
    }

    public function hydrateTransactions(\SimpleXMLElement $xml)
    {
        $this->initializeTransactions();

        if (isset($xml->Transactions) && isset($xml->Transactions->Transaction) && !empty($xml->Transactions->Transaction)) {
            foreach ($xml->Transactions->Transaction as $transactionXml) {
                $transaction = new Transaction();
                $transaction->hydrateXml($transactionXml);
                $this->transactions[] = $transaction;
            }
        }
    }

    private function initializeTransactions()
    {
        if (is_null($this->transactions)) {
            $this->transactions = [];
        }
    }
}
