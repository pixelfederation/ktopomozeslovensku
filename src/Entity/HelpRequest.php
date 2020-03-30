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
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HelpRequesRepository")
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
     * @var RecipientGroup|null
     * @ORM\ManyToOne(targetEntity="App\Entity\RecipientGroup", inversedBy="helpRequests")
     * @ORM\JoinColumn(name="recipient_group_id", referencedColumnName="id")
     */
    private $recipientGroup;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\HelpRequestsItems", mappedBy="helpRequest", cascade={"persist"})
     */
    private $requestedItems;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="requested_text", nullable=true)
     */
    private $requestedText;

    /**
     * @var bool
     */
    private $policy;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="resolved")
     */
    private $resolved = false;

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
     * @return Collection
     */
    public function getRequestedItems(): Collection
    {
        return $this->requestedItems;
    }

    /**
     * @param Collection $requestedItems
     */
    public function setRequestedItems(Collection $requestedItems): void
    {
        $this->requestedItems = $requestedItems;
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
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s [%s]', $this->getInstitutionName(), $this->getContactPerson());
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
     */
    public function setResolved(bool $resolved): void
    {
        $this->resolved = $resolved;
    }

    /**
     * @return string
     */
    public function getRequestedText(): ?string
    {
        return $this->requestedText;
    }

    /**
     * @param string $requestedText
     */
    public function setRequestedText(string $requestedText): void
    {
        $this->requestedText = $requestedText;
    }

    /**
     * @return RecipientGroup|null
     */
    public function getRecipientGroup(): ?RecipientGroup
    {
        return $this->recipientGroup;
    }

    /**
     * @param RecipientGroup|null $recipientGroup
     *
     * @return void
     */
    public function setRecipientGroup(?RecipientGroup $recipientGroup): void
    {
        $this->recipientGroup = $recipientGroup;
    }
}
