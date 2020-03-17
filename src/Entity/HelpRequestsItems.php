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
 * @ORM\Table(name="help_requests_items")
 */
final class HelpRequestsItems
{
    /**
     * @var DonationRequest
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\HelpRequest", inversedBy="requestedItems")
     * @ORM\JoinColumn(name="help_request_id")
     */
    private $helpRequest;

    /**
     * @var DonationItem
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationItem", inversedBy="requestedItems")
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
     * @param HelpRequest $request
     * @param DonationItem $item
     * @param int $quantity
     */
    private function __construct(HelpRequest $request, DonationItem $item, int $quantity)
    {
        $this->helpRequest = $request;
        $this->item = $item;
        $this->quantity = $quantity;
    }

    /**
     * @param HelpRequest $request
     * @param DonationItem $item
     * @param int $quantity
     *
     * @return HelpRequestsItems
     */
    public static function fromRequest(HelpRequest $request, DonationItem $item, int $quantity): HelpRequestsItems
    {
        return new self($request, $item, $quantity);
    }

    /**
     * @return DonationRequest
     */
    public function getHelpRequest(): DonationRequest
    {
        return $this->helpRequest;
    }

    /**
     * @param DonationRequest $helpRequest
     */
    public function setHelpRequest(DonationRequest $helpRequest): void
    {
        $this->helpRequest = $helpRequest;
    }

    /**
     * @return DonationItem
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param DonationItem $item
     */
    public function setItem(DonationItem $item): void
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
