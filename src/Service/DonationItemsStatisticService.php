<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Repository\DonationItemRepository;

/**
 *
 */
final class DonationItemsStatisticService
{
    /**
     * @var DonationItemRepository
     */
    private $donationItemRepository;

    /**
     * @param DonationItemRepository $donationItemRepository
     */
    public function __construct(DonationItemRepository $donationItemRepository)
    {
        $this->donationItemRepository = $donationItemRepository;
    }

    /**
     * @return array
     */
    public function getStatistics(): array
    {
        return $this->donationItemRepository->getItemStatistics();
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function getStatisticsLimited(int $limit): array
    {
        return $this->donationItemRepository->getItemStatisticsWithLimit($limit);
    }
}
