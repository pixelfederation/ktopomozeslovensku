<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Model;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

/**
 *
 */
final class Transaction
{
    /**
     * @var DateTimeImmutable
     *
     * @Serializer\Type(name="DateTimeImmutable<'Y-m-dP'>")
     * @Serializer\SerializedName("date")
     */
    private $date;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("offsetAccountNumber")
     */
    private $offsetAccountNumber;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("offsetAccountName")
     */
    private $offsetAccountName;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("bankName")
     */
    private $bankName;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("userIdentification")
     */
    private $userIdentification;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("message")
     */
    private $message;

    /**
     * @var float
     *
     * @Serializer\Type(name="float")
     * @Serializer\SerializedName("amount")
     */
    private $amount;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("transactionId")
     */
    private $transactionId;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("executionId")
     */
    private $executionId;

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getOffsetAccountNumber(): ?string
    {
        return $this->offsetAccountNumber;
    }

    /**
     * @return string
     */
    public function getOffsetAccountName(): ?string
    {
        return $this->offsetAccountName;
    }

    /**
     * @return string
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @return string
     */
    public function getUserIdentification(): ?string
    {
        return $this->userIdentification;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
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
}
