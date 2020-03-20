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
final class Info
{
    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("accountId")
     */
    private $accountId;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("bankId")
     */
    private $bankId;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("currency")
     */
    private $currency;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("iban")
     */
    private $iban;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("bic")
     */
    private $bic;

    /**
     * @var float
     *
     * @Serializer\Type(name="float")
     * @Serializer\SerializedName("openingBalance")
     */
    private $openingBalance;

    /**
     * @var float
     *
     * @Serializer\Type(name="float")
     * @Serializer\SerializedName("closingBalance")
     */
    private $closingBalance;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("dateStart")
     */
    private $dateStart;

    /**
     * @var string
     *
     * @Serializer\Type(name="string")
     * @Serializer\SerializedName("dateEnd")
     */
    private $dateEnd;

    /**
     * @var integer
     *
     * @Serializer\Type(name="int")
     * @Serializer\SerializedName("idFrom")
     */
    private $idFrom;

    /**
     * @var integer
     *
     * @Serializer\Type(name="int")
     * @Serializer\SerializedName("idTo")
     */
    private $idTo;

    /**
     * @var integer|null
     *
     * @Serializer\Type(name="int")
     * @Serializer\SerializedName("idLastDownload")
     */
    private $idLastDownload;

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getBankId(): string
    {
        return $this->bankId;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @return string
     */
    public function getBic(): string
    {
        return $this->bic;
    }

    /**
     * @return float
     */
    public function getOpeningBalance(): float
    {
        return $this->openingBalance;
    }

    /**
     * @return float
     */
    public function getClosingBalance(): float
    {
        return $this->closingBalance;
    }

    /**
     * @return string
     */
    public function getDateStart(): string
    {
        return $this->dateStart;
    }

    /**
     * @return string
     */
    public function getDateEnd(): string
    {
        return $this->dateEnd;
    }

    /**
     * @return int
     */
    public function getIdFrom(): int
    {
        return $this->idFrom;
    }

    /**
     * @return int
     */
    public function getIdTo(): int
    {
        return $this->idTo;
    }

    /**
     * @return int|null
     */
    public function getIdLastDownload(): ?int
    {
        return $this->idLastDownload;
    }
}
