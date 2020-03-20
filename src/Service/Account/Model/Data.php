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
final class Data
{
    /**
     * @var AccountStatement
     *
     * @Serializer\Type(name="App\Service\Account\Model\AccountStatement")
     * @Serializer\SerializedName("accountStatement")
     */
    private $accountStatement;

    /**
     * @return AccountStatement
     */
    public function getAccountStatement(): AccountStatement
    {
        return $this->accountStatement;
    }
}
