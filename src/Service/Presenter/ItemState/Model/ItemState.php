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
use App\Entity\HelpRequestsItems;

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
     * @var string|null
     */
    private $name;

    private $itemId;

    /**
     * @param DonationItem|null $item
     */
    public function __construct(DonationItem $item, HelpRequestsItems $requested = null)
    {
        if ($item->getDonations()->isEmpty()) {
            $this->donated = 0;
        }
        if (!$item->getDonations()->isEmpty()) {
            $this->donated = array_reduce($item->getDonations()->toArray(), function($result, Donation $donation) {
                return $result + $donation->getCount();
            });
        }
        $this->name = $item->getName();
        $this->itemId = $item->getId();
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @param int $requested
     *
     * @return void
     */
    public function setRequested(int $requested): void
    {
        $this->requested = $requested;
    }
}
