<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="help_request")
 */
final class HelpRequest
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="institution_name")
     *
     * @Assert\NotBlank
     */
    private $institutionName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="contact_person")
     *
     * @Assert\NotBlank
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="telephone")
     *
     * @Assert\NotBlank
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="email")
     *
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="request_text")
     *
     * @Assert\NotBlank
     */
    private $requestText;

    /**
     * @var bool
     */
    private $policy;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
    private function setPolicy(bool $policy): void
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
}
