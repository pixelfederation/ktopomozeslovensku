<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Presenter\ItemState\Model;

use App\Entity\Donation;
use App\Entity\DonationItem;

/**
 * Model for presenting state of one item
 */
final class ItemState
{
    /**
     * @var int
     */
    private $requested;

    /**
     * @var int
     */
    private $donated;

    /**
     * @var int
     */
    private $sub;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param DonationItem $item
     */
    public function __construct(DonationItem $item)
    {
        $this->requested = $item->getRequestedItems()->count();
        $this->donated = array_reduce($item->getDonations()->toArray(), function(Donation $donation) {
            return $donation->getCount();
        });
        $this->sub = $this->requested - $this->donated;
        $this->name = $item->getName();
    }

    /**
     * @return int
     */
    public function getRequested(): int
    {
        return $this->requested;
    }

    /**
     * @return int
     */
    public function getDonated(): int
    {
        return $this->donated;
    }

    /**
     * @return int
     */
    public function getSub(): int
    {
        return $this->sub;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
