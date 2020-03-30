<?php
declare(strict_types=1);

/*
 * @author mfris
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\AccountActualBalance;
use App\Model\AccountReport;
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
     * @return AccountReport
     */
    public function getAccountReport(): AccountReport
    {
        /** @var AccountActualBalance|null $result */
        $result = $this->repository->findOneBy([]);

        if ($result ===  null) {
            return AccountReport::emptyAccount();
        }

        return new AccountReport(
            $result->getDebit(),
            $result->getCredit(),
            $result->getBalance()
        );
    }
}
