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
class Item
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
     * @var Collection|HelpRequestsItems[]|array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\HelpRequestsItems", mappedBy="item")
     */
    private $requestedItems;

    /**
     * @var Collection|DonationRequest[]|array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DonationRequestsItems", mappedBy="item")
     */
    private $donatedItems;

    /**
     *
     */
    public function __construct()
    {
        $this->requestedItems = new ArrayCollection();
        $this->donatedItems = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return HelpRequestsItems[]|array|Collection
     */
    public function getRequestedItems()
    {
        return $this->requestedItems;
    }

    /**
     * @return DonationRequest[]|array|Collection
     */
    public function getDonatedItems()
    {
        return $this->donatedItems;
    }


}
