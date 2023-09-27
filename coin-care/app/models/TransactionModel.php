<?php

class TransactionModel
{
    private $transaction;
    private $deposit;
    private $withdraw;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
    }

    public function getTransaction()
    {
        return $this->transaction;
    }

    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    public function getDeposit()
    {
        return $this->deposit;
    }

    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;

        return $this;
    }

    public function getWithdraw()
    {
        return $this->withdraw;
    }

    public function setWithdraw($withdraw)
    {
        $this->withdraw = $withdraw;

        return $this;
    }

    /* FUNÇÃO DE FAZER DEPOSITO
    public function makeDeposit()
    {
        $this->transaction = new TransactionModel();
        $this->transaction->setAmount($this->getAmount());
        $this->transaction->setTransactionType('Deposit');
        $this->transaction->setTransactionDate(date('Y-m-d H:i:s'));
        $this->transaction->save();
    }
    */ 
}