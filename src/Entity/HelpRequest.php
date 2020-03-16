<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity()
 * @ORM\Table(name="help_request")
 * @ORM\HasLifecycleCallbacks()
 */
class HelpRequest
{
    /**
     * @var int
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="institution_name")
     */
    private $institutionName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="contact_person")
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="telephone")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="email")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="address")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="request_text")
     */
    private $requestText;

    /**
     * @var Collection|HelpRequestsItems[]|array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\HelpRequestsItems", mappedBy="helpRequest")
     */
    private $requestedItems;

    /**
     * @var bool
     */
    private $policy;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
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
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getInstitutionName(): ?string
    {
        return $this->institutionName;
    }

    /**
     * @param string $institutionName
     */
    public function setInstitutionName(string $institutionName): void
    {
        $this->institutionName = $institutionName;
    }

    /**
     * @return string
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * @param string $contactPerson
     */
    public function setContactPerson(string $contactPerson): void
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRequestText(): ?string
    {
        return $this->requestText;
    }

    /**
     * @param string $requestText
     */
    public function setRequestText(string $requestText): void
    {
        $this->requestText = $requestText;
    }

    /**
     * @param bool $policy
     *
     * @return void
     */
    public function setPolicy(bool $policy): void
    {
        $this->policy = $policy;
    }

    /**
     * @return bool
     */
    public function getPolicy(): ?bool
    {
        return $this->policy;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @param Item $item
     * @param int $quantity
     *
     * @return void
     */
    public function addHelpRequestItem(Item $item, int $quantity): void
    {
        if ($this->requestedItems->contains($item)) {
            return;
        }

        $this->requestedItems->add(HelpRequestsItems::fromRequest($this, $item, $quantity));
    }
}
