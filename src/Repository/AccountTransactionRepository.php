<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Repository;

use App\Service\Account\Model\AggregatedTransactionBalance;
use DateTimeImmutable;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 *
 */
final class AccountTransactionRepository extends EntityRepository
{
    /**
     * @param DateTimeImmutable $date
     *
     * @return AggregatedTransactionBalance|null ?AggregatedDayBalance
     */
    public function getAggregatedBalanceForDate(DateTimeImmutable $date): ?AggregatedTransactionBalance
    {
        $result =  $this->createAggregatedBalanceQuery()
            ->where('at.date = :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();

        if (!isset($result[0])) {
            return null;
        }

        return $this->hydrateToAggregateBalance($result[0]);
    }

    /**
     * @return array
     */
    public function getAggregatedBalance(): array
    {
        $result = $this->createAggregatedBalanceQuery()
            ->groupBy('at.date')
            ->orderBy('at.date', 'ASC')
            ->getQuery()
            ->getResult();

        return array_map(function (array $data) {
            return $this->hydrateToAggregateBalance($data);
        }, $result);
    }

    /**
     * @param array $data
     *
     * @return AggregatedTransactionBalance
     */
    private function hydrateToAggregateBalance(array $data): AggregatedTransactionBalance
    {
        return new AggregatedTransactionBalance(
            $data['date'],
            (float) $data['credit'],
            (float) $data['debit'],
            (int) $data['credit_count'],
            (int) $data['debit_count']
        );
    }

    /**
     * @return QueryBuilder
     */
    private function createAggregatedBalanceQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('at')
            ->select("
                at.date as date,
                sum(at.credit) as credit,
                sum(at.debit) as debit,
                sum(case when at.credit = 0 then 'null' else 1 end) as credit_count,
                sum(case when at.debit = 0 then 'null' else 1 end) as debit_count
            ");
    }
}
