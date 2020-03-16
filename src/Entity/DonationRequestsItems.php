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
 * @ORM\Entity()
 * @ORM\Table(name="donation_requests_items")
 */
final class DonationRequestsItems
{
    /**
     * @var DonationRequest
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationRequest", inversedBy="donatedItems")
     * @ORM\JoinColumn(name="donation_request_id")
     */
    private $donationRequest;

    /**
     * @var Item
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="donatedItems")
     * @ORM\JoinColumn(name="item_id")
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", length=64)
     */
    private $quantity;

    /**
     * @param DonationRequest $request
     * @param Item $item
     * @param int $quantity
     */
    private function __construct(DonationRequest $request, Item $item, int $quantity)
    {
        $this->donationRequest = $request;
        $this->item = $item;
        $this->quantity = $quantity;
    }

    /**
     * @param DonationRequest $request
     * @param Item $item
     * @param int $quantity
     *
     * @return DonationRequestsItems
     */
    public static function fromRequest(DonationRequest $request, Item $item, int $quantity): DonationRequestsItems
    {
        return new self($request, $item, $quantity);
    }

    /**
     * @return DonationRequest
     */
    public function getDonationRequest(): DonationRequest
    {
        return $this->donationRequest;
    }

    /**
     * @param DonationRequest $donationRequest
     */
    public function setDonationRequest(DonationRequest $donationRequest): void
    {
        $this->donationRequest = $donationRequest;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item): void
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
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
}
