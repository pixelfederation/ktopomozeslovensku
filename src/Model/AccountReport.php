<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Model;

/**
 *
 */
final class AccountReport
{
    /**
     * @var float
     */
    private $debit;

    /**
     * @var float
     */
    private $credit;

    /**
     * @var float
     */
    private $balance;

    /**
     * @param float $debit
     * @param float $credit
     * @param float $balance
     *
     */
    public function __construct(float $debit, float $credit, float $balance)
    {
        $this->debit = $debit;
        $this->credit = $credit;
        $this->balance = $balance;
    }

    /**
     * @return AccountReport
     */
    public static function emptyAccount(): AccountReport
    {
        return new self(0.0,0.0,0.0);
    }

    /**
     * @return float
     */
    public function getDebit(): float
    {
        return $this->debit;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }
}
