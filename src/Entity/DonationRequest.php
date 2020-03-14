<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use DateTimeImmutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="donation_request")
 */
class DonationRequest
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private $createdAt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, name="contact_person")
     */
    private $contactPerson;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, name="telephone")
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, name="address")
     */
    private $address;

    /**
     * @var DonationItem|null
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationItem", inversedBy="requests")
     * @ORM\JoinColumn(name="donation_item_id", referencedColumnName="id")
     */
    private $donationItem;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", length=255, name="quantity")
     */
    private $quantity;

    /**
     * @var bool|null
     */
    private $policy;

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * @param string|null $contactPerson
     */
    public function setContactPerson(?string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return DonationItem|null
     */
    public function getDonationItem(): ?DonationItem
    {
        return $this->donationItem;
    }

    /**
     * @param DonationItem|null $donationItem
     */
    public function setDonationItem(?DonationItem $donationItem): void
    {
        $this->donationItem = $donationItem;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool|null
     */
    public function getPolicy(): ?bool
    {
        return $this->policy;
    }

    /**
     * @param bool|null $policy
     */
    public function setPolicy(?bool $policy): void
    {
        $this->policy = $policy;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('[%s](%s): %s', $this->getContactPerson(), $this->getQuantity(), $this->donationItem->getName());
    }

}
