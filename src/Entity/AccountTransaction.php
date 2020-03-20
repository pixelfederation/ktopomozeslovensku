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
 * @ORM\Entity(repositoryClass="App\Repository\AccountTransactionRepository")
 * @ORM\Table(name="account_transaction", indexes={@ORM\Index(name="search_idx", columns={"date"})})
 * @ORM\HasLifecycleCallbacks()
 */
final class AccountTransaction
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
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="date_immutable", name="date")
     */
    private $date;

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
     * @var string
     *
     * @ORM\Column(type="bigint", name="transaction_id", unique=true)
     */
    private $transactionId;

    /**
     * @var string
     *
     * @ORM\Column(type="bigint", name="execution_id")
     */
    private $executionId;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", name="created_at", nullable=false)
     */
    private $createdAt;

    /**
     * @param DateTimeImmutable $date
     * @param float $credit
     * @param float $debit
     * @param string $transactionId
     * @param string $executionId
     */
    public function __construct(
        DateTimeImmutable $date,
        float $credit,
        float $debit,
        string $transactionId,
        string $executionId
    ) {

        $this->date = $date;
        $this->credit = $credit;
        $this->debit = $debit;
        $this->transactionId = $transactionId;
        $this->executionId = $executionId;
    }

    /**
     * @ORM\PrePersist
     */
    public function updateTimestamps(): void
    {
        $this->createdAt = new DateTimeImmutable('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getExecutionId(): string
    {
        return $this->executionId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
