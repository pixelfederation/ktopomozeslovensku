<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Form\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 */
final class HelpRequestForm
{
    /**
     * @var string|null
     */
    private $institutionName;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $contactPerson;

    /**
     * @var string|null
     */
    private $telephone;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var ArrayCollection|null
     */
    private $items;

    /**
     * @var bool|null
     */
    private $policy;

    /**
     * @return string|null
     */
    public function getInstitutionName(): ?string
    {
        return $this->institutionName;
    }

    /**
     * @param string|null $institutionName
     */
    public function setInstitutionName(?string $institutionName): void
    {
        $this->institutionName = $institutionName;
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
     * @return ArrayCollection|null
     */
    public function getItems(): ?array
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection|null $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
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
}
