<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 *
 */
final class TransactionList
{
    /**
     * @var array<Transaction>
     *
     * @Serializer\Type(name="array<Transaction>")
     * @Serializer\SerializedName("transaction")
     */
    private $transaction;

    /**
     * @return array|Transaction[]
     */
    public function getTransaction(): array
    {
        return $this->transaction;
    }
}
