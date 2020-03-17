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

/**
 * @ORM\Entity()
 * @ORM\Table(name="donation_item")
 */
class DonationItem
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, name="value", unique=true)
     */
    private $name;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DonationRequestsItems", mappedBy="item")
     */
    private $donatedItems;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\HelpRequestsItems", mappedBy="item")
     */
    private $requestedItems;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Donation", mappedBy="donationItem")
     */
    private $donations;

    /**
     *
     */
    public function __construct()
    {
        $this->donatedItems = new ArrayCollection();
        $this->requestedItems = new ArrayCollection();
        $this->donations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName() ?? '';
    }

    /**
     * @return Collection
     */
    public function getDonations(): Collection
    {
        return $this->donations;
    }

    /**
     * @return Collection
     */
    public function getDonatedItems(): Collection
    {
        return $this->donatedItems;
    }

    /**
     * @return Collection
     */
    public function getRequestedItems(): Collection
    {
        return $this->requestedItems;
    }
}
