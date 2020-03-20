<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Model;

/**
 *
 */
final class AggregatedBalance
{
    /**
     * @var float
     */
    private $credit;

    /**
     * @var float
     */
    private $debit;

    /**
     * @var int
     */
    private $creditCount;

    /**
     * @var int
     */
    private $debitCount;

    /**
     * @param float $credit
     * @param float $debit
     * @param int $creditCount
     * @param int $debitCount
     *
     */
    public function __construct(float $credit, float $debit, int $creditCount, int $debitCount)
    {
        $this->credit = $credit;
        $this->debit = $debit;
        $this->creditCount = $creditCount;
        $this->debitCount = $debitCount;
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
    public function getDebit(): float
    {
        return $this->debit;
    }

    /**
     * @return int
     */
    public function getCreditCount(): int
    {
        return $this->creditCount;
    }

    /**
     * @return int
     */
    public function getDebitCount(): int
    {
        return $this->debitCount;
    }

    /**
     * @param float $credit
     */
    public function setCredit(float $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @param float $debit
     */
    public function setDebit(float $debit): void
    {
        $this->debit = $debit;
    }

    /**
     * @param int $creditCount
     */
    public function setCreditCount(int $creditCount): void
    {
        $this->creditCount = $creditCount;
    }

    /**
     * @param int $debitCount
     */
    public function setDebitCount(int $debitCount): void
    {
        $this->debitCount = $debitCount;
    }
}
