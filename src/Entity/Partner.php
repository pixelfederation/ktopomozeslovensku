<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="partner")
 */
/* final */class Partner
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, name="name")
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", name="donated_amount")
     */
    private $donatedAmount;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="non_finacial_help")
     */
    private $nonFinacialHelp;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="date_immutable", name="helped_at")
     */
    private $helpedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDonatedAmount()
    {
        return $this->donatedAmount;
    }

    /**
     * @param int $donatedAmount
     */
    public function setDonatedAmount(int $donatedAmount): void
    {
        $this->donatedAmount = $donatedAmount;
    }

    /**
     * @return bool
     */
    public function getNonFinacialHelp()
    {
        return $this->nonFinacialHelp;
    }

    /**
     * @param bool $nonFinacialHelp
     */
    public function setNonFinacialHelp(bool $nonFinacialHelp): void
    {
        $this->nonFinacialHelp = $nonFinacialHelp;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getHelpedAt()
    {
        return $this->helpedAt;
    }

    /**
     * @param DateTimeImmutable $helpedAt
     */
    public function setHelpedAt(DateTimeImmutable $helpedAt): void
    {
        $this->helpedAt = $helpedAt;
    }
}
