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
    private $requested = 0;

    /**
     * @var int
     */
    private $donated = 0;

    /**
     * @var int
     */
    private $sub;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @param DonationItem|null $item
     */
    public function __construct(DonationItem $item)
    {
        $this->requested = $item->getRequestedItems()->count();
        if ($item->getDonations()->isEmpty()) {
            $this->donated = 0;
        }
        if (!$item->getDonations()->isEmpty()) {
            $this->donated = array_reduce($item->getDonations()->toArray(), function($result, Donation $donation) {
                return $result + $donation->getCount();
            });
        }
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
