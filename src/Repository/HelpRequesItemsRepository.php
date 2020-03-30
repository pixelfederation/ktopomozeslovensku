<?php
declare(strict_types=1);
/*
 * @author pbrecska ň */


namespace App\Repository;

use App\Entity\HelpRequestsItems;
use App\Service\Account\Model\AggregatedTransactionBalance;
use Doctrine\ORM\EntityRepository;

/**
 */
final class HelpRequesItemsRepository extends EntityRepository
{
    /**
     * @param int $iteId
     */
    public function getItemCounts(int $iteId): int
    {
        $result = $this->createQueryBuilder('hrItem')
            ->select(['SUM(hrItem.quantity) as quantity'])
            ->where('hrItem.item = :item')
            ->setParameter('item', $iteId)
            ->getQuery()
            ->getSingleScalarResult();

        if (!isset($result[0])) {
            return 0;
        }

        return (int)$result;
    }


}
