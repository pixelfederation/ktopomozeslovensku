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
