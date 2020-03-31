<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountActualBalanceRepository")
 * @ORM\Table(name="account_actual_balance")
 * @ORM\HasLifecycleCallbacks()
 */
/* final */class AccountActualBalance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="credit")
     */
    private $credit;

    /**
     * @var float
     *
     * @ORM\Column(type="float", name="debit")
     */
    private $debit;

    /**
     * @var int
     *
     *
     * @ORM\Column(type="integer", name="credit_count")
     */
    private $creditCount;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="debit_count")
     */
    private $debitCount;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="updated_at", nullable=false)
     */
    private $updatedAt;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $this->updatedAt = new DateTimeImmutable('now');
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

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->getCredit() - $this->getDebit();
    }

    /**
     * @return int
     */
    public function getBalanceCount(): int
    {
        return $this->getDebitCount() + $this->getCreditCount();
    }
}
