<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HelpRequesItemsRepository")
 * @ORM\Table(name="help_requests_items")
 */
final class HelpRequestsItems
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
     * @var HelpRequest|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\HelpRequest", inversedBy="requestedItems")
     * @ORM\JoinColumn(name="help_request_id", nullable=false)
     */
    private $helpRequest;

    /**
     * @var DonationItem|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationItem", inversedBy="requestedItems")
     * @ORM\JoinColumn(name="item_id", nullable=true)
     */
    private $item;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantity", type="integer", length=64, nullable=true)
     */
    private $quantity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="other", type="text", nullable=true)
     */
    private $other;

    /**
     * @return HelpRequest
     */
    public function getHelpRequest(): ?HelpRequest
    {
        return $this->helpRequest;
    }

    /**
     * @param HelpRequest $helpRequest
     */
    public function setHelpRequest(?HelpRequest $helpRequest): void
    {
        $this->helpRequest = $helpRequest;
    }

    /**
     * @return DonationItem
     */
    public function getItem(): ?DonationItem
    {
        return $this->item;
    }

    /**
     * @param DonationItem $item
     */
    public function setItem(?DonationItem $item): void
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
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
     * @return string|null
     */
    public function getOther(): ?string
    {
        return $this->other;
    }

    /**
     * @param string|null $other
     */
    public function setOther(?string $other): void
    {
        $this->other = $other;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->item === null) {
            return sprintf('ine: %s (%s) pcs', $this->other, $this->quantity ?? 0);

        }

        return sprintf('%s (%s) pcs', $this->item->getName(), $this->quantity ?? 0);
    }
}
