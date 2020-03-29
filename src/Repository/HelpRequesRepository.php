<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * {comment what interface or class does. This comment is not specifically necessary, but it is recommended.}
 */
final class HelpRequesRepository extends EntityRepository
{
    /**
     */
    public function getCounts(): ?array
    {
        $result = $this->createQueryBuilder('request')
            ->select(['count(request.recipientGroup) as count', 'rg.name'])
            ->innerJoin('request.recipientGroup', 'rg' )
            ->groupBy('request.recipientGroup')
            ->getQuery()
            ->getResult();

        if (!isset($result[0])) {
            return null;
        }

        return $result;
    }


}
