<?php
declare(strict_types=1);

/*
 * @author mfris
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\AccountActualBalance;
use App\Repository\AccountActualBalanceRepository;

/**
 *
 */
final class TransparentAccountReporterService
{
    /**
     * @var AccountActualBalanceRepository
     */
    private $repository;

    /**
     * @param AccountActualBalanceRepository $repository
     */
    public function __construct(AccountActualBalanceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getAmounts(): array
    {
        /** @var AccountActualBalance|null $result */
        $result = $this->repository->findOneBy([]);

        return [
            'credit' => $result->getCredit(),
            'debit' => $result->getDebit(),
            'balance' => $result->getBalance(),
        ];
    }
}
