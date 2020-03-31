<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Repository;

use App\Model\ItemStatistic;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 *
 */
final class DonationItemRepository extends EntityRepository
{
    /**
     * @return array|ItemStatistic[]
     */
    public function getItemStatistics(): array
    {
        return $this->getItemStatisticsResult(null);
    }

    /**
     * @param int $limit
     *
     * @return array|ItemStatistic[]
     *
     */
    public function getItemStatisticsWithLimit(int $limit): array
    {
        return $this->getItemStatisticsResult($limit);
    }

    /**
     * @param int|null $limit
     *
     * @return array|ItemStatistic[]
     */
    private function getItemStatisticsResult(int $limit = null): array
    {
        $resultSetMapping = new ResultSetMapping();
        $resultSetMapping->addScalarResult('value', 'name', 'string');
        $resultSetMapping->addScalarResult('requested', 'requested', 'integer');
        $resultSetMapping->addScalarResult('donated', 'donated', 'integer');
        $resultSetMapping->addScalarResult('difference', 'difference', 'integer');

        //Todo refactor this to DQL!!!
        $query = '
            select dig.value,
                sum(ri.requested)                   as requested,
                sum(di.donated)                     as donated,
                sum(ri.requested) - sum(di.donated) as difference
            from donation_item d
                left join (select hri.item_id as item_id, sum(hri.quantity) as requested
                    from help_requests_items hri
                    where hri.other is null
                    group by hri.item_id) ri on ri.item_id = d.id
                left join (select d.donation_item_id, sum(d.item_count) as donated
                    from donation d
                    group by d.donation_item_id) di on di.donation_item_id = d.id
                    left join donation_item_group dig on d.group_id = dig.id
            where ri.requested is not null
              and d.group_id is not null
            group by d.group_id
            order by sum(di.donated) DESC
        ';

        if ($limit !== null) {
            $query = sprintf('%s LIMIT %s', $query, $limit);
        }

        $nativeQuery = $this->getEntityManager()
            ->createNativeQuery(sprintf('%s;', $query), $resultSetMapping);

        return array_map(static function (array $result) {
            return new ItemStatistic(
                (string) $result['name'],
                (int) ($result['requested'] ?? 0),
                (int) ($result['donated'] ?? 0),
                (static function (array $result): int {
                    if (!isset($result['difference'])) {
                        return 0;
                    }
                    return $result['difference'] > 0 ? $result['difference'] : 0;
                })($result)
            );
        }, $nativeQuery->getArrayResult());
    }
}




