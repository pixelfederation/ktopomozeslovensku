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
 * @ORM\Table(name="account_transaction", indexes={@ORM\Index(name="search_idx", columns={"date"}), @ORM\Index(name="name_idx", columns={"offset_account_name"})})
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
     * @var string|null
     *
     * @ORM\Column(type="string", name="offset_account_number", nullable=true)
     */
    private $offsetAccountNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", name="offset_account_name", nullable=true)
     */
    private $offsetAccountName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", name="bank_name", nullable=true)
     */
    private $bankName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", name="user_identification", nullable=true)
     */
    private $userIdentification;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", name="message", nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="execution_id", nullable=true)
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
     * @param string|null $offsetAccountNumber
     * @param string|null $offsetAccountName
     * @param string|null $bankName
     * @param string|null $userIdentification
     * @param string|null $message
     * @param string $executionId
     */
    public function __construct(
        DateTimeImmutable $date,
        float $credit,
        float $debit,
        string $transactionId,
        string $executionId,
        ?string $offsetAccountNumber,
        ?string $offsetAccountName,
        ?string $bankName,
        ?string $userIdentification,
        ?string $message
    ) {
        $this->date = $date;
        $this->credit = $credit;
        $this->debit = $debit;
        $this->transactionId = $transactionId;
        $this->executionId = $executionId;
        $this->offsetAccountNumber = $offsetAccountNumber;
        $this->offsetAccountName = $offsetAccountName;
        $this->bankName = $bankName;
        $this->userIdentification = $userIdentification;
        $this->message = $message;
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

    /**
     * @return string|null
     */
    public function getOffsetAccountNumber(): ?string
    {
        return $this->offsetAccountNumber;
    }

    /**
     * @return string|null
     */
    public function getOffsetAccountName(): ?string
    {
        return $this->offsetAccountName;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @return string|null
     */
    public function getUserIdentification(): ?string
    {
        return $this->userIdentification;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
