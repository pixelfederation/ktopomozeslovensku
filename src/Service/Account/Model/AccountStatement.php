<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account\Model;

use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;

/**
 *
 */
final class AccountStatement
{
    /**
     * @var Info
     *
     * @Serializer\Type(name="App\Service\Account\Model\Info")
     * @Serializer\SerializedName("info")
     */
    private $info;

    /**
     * @var TransactionList
     *
     * @Serializer\Type(name="App\Service\Account\Model\TransactionList")
     * @Serializer\SerializedName("transactionList")
     */
    private $transactionList;

    /**
     * @return Info
     */
    public function getInfo(): Info
    {
        return $this->info;
    }

    /**
     * @return TransactionList
     */
    public function getTransactionList(): TransactionList
    {
        return $this->transactionList;
    }
}
