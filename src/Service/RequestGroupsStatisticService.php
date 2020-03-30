<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Model\RequestGroupStatistic;
use App\Repository\HelpRequestRepository;

/**
 *
 */
final class RequestGroupsStatisticService
{
    /**
     * @var HelpRequestRepository
     */
    private $helpRequestRepository;

    /**
     * @param HelpRequestRepository $helpRequestRepository
     */
    public function __construct(HelpRequestRepository $helpRequestRepository)
    {
        $this->helpRequestRepository = $helpRequestRepository;
    }

    /**
     *
     * @return array|RequestGroupStatistic[]
     */
    public function getStatistics(): array
    {
        return $this->helpRequestRepository->getStatistics();
    }
}
