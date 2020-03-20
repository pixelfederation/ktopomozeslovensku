<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Model;

use DateTimeImmutable;

/**
 *
 */
final class AggregatedTransactionBalance
{
    /**
     * @var DateTimeImmutable
     */
    private $date;

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
     * @param DateTimeImmutable $date
     * @param float $credit
     * @param float $debit
     * @param int $creditCount
     * @param int $debitCount
     *
     */
    public function __construct(
        DateTimeImmutable $date,
        float $credit,
        float $debit,
        int $creditCount,
        int $debitCount
    ) {
        $this->date = $date;
        $this->credit = $credit;
        $this->debit = $debit;
        $this->creditCount = $creditCount;
        $this->debitCount = $debitCount;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
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
}
