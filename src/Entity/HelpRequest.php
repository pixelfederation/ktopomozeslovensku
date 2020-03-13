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
     * @param string $institutionName
     * @param string $contactPerson
     * @param string $telephone
     * @param string $email
     * @param string $requestText
     */
    public function __construct(
        string $institutionName,
        string $contactPerson,
        string $telephone,
        string $email,
        string $requestText
    ) {
        $this->institutionName = $institutionName;
        $this->contactPerson = $contactPerson;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->requestText = $requestText;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getInstitutionName(): string
    {
        return $this->institutionName;
    }

    /**
     * @return string
     */
    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRequestText(): string
    {
        return $this->requestText;
    }
}
