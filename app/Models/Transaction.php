<?php

namespace App\Models;

class Transaction
{
    private $date;
    private $transactionCode;
    private $customerNumber;
    private $reference;
    private $amount;
    private $valid;

    /**
     * @param mixed $date
     * @return Transaction
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $transactionCode
     * @return Transaction
     */
    public function setTransactionCode($transactionCode)
    {
        $this->transactionCode = $transactionCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * @param mixed $customerNumber
     * @return Transaction
     */
    public function setCustomerNumber($customerNumber)
    {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerNumber()
    {
        return $this->customerNumber;
    }

    /**
     * @param mixed $reference
     * @return Transaction
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $amount
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $valid
     * @return Transaction
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }


}