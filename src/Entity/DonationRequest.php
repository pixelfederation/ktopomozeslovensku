<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Exception;

/**
 * @ORM\Entity()
 * @ORM\Table(name="donation_request")
 * @ORM\HasLifecycleCallbacks()
 */
/* final */class DonationRequest
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
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
     * @ORM\Column(type="string", length=255, name="email")
     */
    private $email;

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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DonationRequestsItems", mappedBy="donationRequest", cascade={"persist"})
     */
    private $donatedItems;

    /**
     * @var bool|null
     */
    private $policy;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="resolved")
     */
    private $resolved = false;

    /**
     *
     */
    public function __construct()
    {
        $this->donatedItems = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getDonatedItems(): Collection
    {
        return $this->donatedItems;
    }

    /**
     * @param Collection $donatedItems
     */
    public function setDonatedItems(Collection $donatedItems): void
    {
        $this->donatedItems = $donatedItems;
    }

    /**
     *
     * @return void
     *
     * @throws Exception
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new DateTimeImmutable();
    }

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
        return sprintf('(%s) %s [%s]', $this->getId(), $this->getContactPerson(), $this->getEmail());
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function getResolved(): bool
    {
        return $this->resolved;
    }

    /**
     * @param bool $resolved
     *
     * @return void
     */
    public function setResolved(bool $resolved): void
    {
        $this->resolved = $resolved;
    }
}
