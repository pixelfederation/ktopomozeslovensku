<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Repository;

use App\Service\Account\Model\AggregatedBalance;
use Doctrine\ORM\EntityRepository;

/**
 *
 */
final class AccountBalanceRepository extends EntityRepository
{
    /**
     * @return AggregatedBalance|null
     */
    public function aggregateBalancePerDay(): ?AggregatedBalance
    {
         $result = $this->createQueryBuilder('ab')
            ->select('
                sum(ab.credit) as credit,
                sum(ab.debit) as debit,
                sum(ab.creditCount) as credit_count,
                sum(ab.debitCount) as debit_count
            ')
             ->getQuery()
             ->getScalarResult();

         if (!isset($result[0])) {
             return null;
         }

         $resultArray = $result[0];

         return new AggregatedBalance(
             (float) $resultArray['credit'],
             (float) $resultArray['debit'],
             (int) $resultArray['credit_count'],
             (int) $resultArray['debit_count']
         );
    }
}
