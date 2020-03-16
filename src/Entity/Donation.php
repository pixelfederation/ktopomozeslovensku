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
 * @ORM\Table(name="donation")
 */
class Donation
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Recipient
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipient", inversedBy="donations")
     * @ORM\JoinColumn(name="recipient_id", referencedColumnName="id", nullable=false)
     */
    private $recipient;

    /**
     * @var DonationItem
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationItem", inversedBy="donations")
     * @ORM\JoinColumn(name="donation_item_id", referencedColumnName="id", nullable=false)
     */
    private $donationItem;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false, name="item_count")
     */
    private $count;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="date_immutable", nullable=false)
     */
    private $donatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient(Recipient $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return DonationItem
     */
    public function getDonationItem()
    {
        return $this->donationItem;
    }

    /**
     * @param DonationItem $donationItem
     */
    public function setDonationItem(DonationItem $donationItem): void
    {
        $this->donationItem = $donationItem;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDonatedAt()
    {
        return $this->donatedAt;
    }

    /**
     * @param DateTimeImmutable $donatedAt
     */
    public function setDonatedAt(DateTimeImmutable $donatedAt): void
    {
        $this->donatedAt = $donatedAt;
    }

    public function __toString(): string
    {
        return sprintf(
            "%s v množstve %d pre %s",
            (string)$this->donationItem,
            $this->count,
            (string)$this->recipient
        );
    }
}
