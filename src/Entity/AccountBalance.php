<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountBalanceRepository")
 * @ORM\Table(name="account_balance", indexes={@ORM\Index(name="search_idx", columns={"date"})})
 * @ORM\HasLifecycleCallbacks()
 */
/* final */class AccountBalance
{
    /**
     * @var int
     *
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
     * @ORM\Column(type="datetime_immutable", name="date", unique=true)
     */
    private $date;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="created_at", nullable=false)
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="updated_at", nullable=false)
     */
    private $updatedAt;

    /**
     * @param DateTimeImmutable $date
     * @param float $credit
     * @param float $debit
     * @param int $creditCount
     * @param int $debitCount
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
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps(): void
    {
        $now = new DateTimeImmutable('now');

        $this->updatedAt = $now;
        if ($this->createdAt === null) {
            $this->createdAt = $now;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
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
     * @return float
     */
    public function getDebit(): float
    {
        return $this->debit;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
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
        return $this->getCreditCount() + $this->getDebitCount();
    }
}
