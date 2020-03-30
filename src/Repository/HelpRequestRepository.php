<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Repository;

use App\Model\RequestGroupStatistic;
use Doctrine\ORM\EntityRepository;

/**
 * {comment what interface or class does. This comment is not specifically necessary, but it is recommended.}
 */
final class HelpRequestRepository extends EntityRepository
{
    /**
     */
    public function getStatistics(): array
    {
        $result = $this->createQueryBuilder('request')
            ->select(['count(request.recipientGroup) as count', 'rg.name'])
            ->innerJoin('request.recipientGroup', 'rg' )
            ->groupBy('request.recipientGroup')
            ->getQuery()
            ->getResult();

        if (!isset($result[0])) {
            return [];
        }

        return array_map(static function (array $result) {
            return new RequestGroupStatistic(
                (string) $result['name'],
                (int) $result['count']
            );
        }, $result);
    }
}
