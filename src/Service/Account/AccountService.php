<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account;

use App\Entity\AccountActualBalance;
use App\Entity\AccountBalance;
use App\Entity\AccountTransaction;
use App\Repository\AccountActualBalanceRepository;
use App\Repository\AccountBalanceRepository;
use App\Repository\AccountTransactionRepository;
use App\Service\Account\Model\AggregatedBalance;
use App\Service\Account\Model\AggregatedTransactionBalance;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 *
 */
final class AccountService
{
    /**
     * @var AccountApiService
     */
    private $downloader;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AccountTransactionRepository
     */
    private $accountTransactionRepository;

    /**
     * @var AccountBalanceRepository
     */
    private $accountBalanceRepository;

    /**
     * @var AccountActualBalanceRepository
     */
    private $accountActualBalanceRepository;


    /**
     * @param AccountApiService $downloader
     * @param EntityManagerInterface $entityManager
     * @param AccountTransactionRepository $accountTransactionRepository
     * @param AccountBalanceRepository $accountBalanceRepository
     * @param AccountActualBalanceRepository $accountActualBalanceRepository
     */
    public function __construct(
        AccountApiService $downloader,
        EntityManagerInterface $entityManager,
        AccountTransactionRepository $accountTransactionRepository,
        AccountBalanceRepository $accountBalanceRepository,
        AccountActualBalanceRepository $accountActualBalanceRepository
    ) {
        $this->downloader = $downloader;
        $this->entityManager = $entityManager;
        $this->accountTransactionRepository = $accountTransactionRepository;
        $this->accountBalanceRepository = $accountBalanceRepository;
        $this->accountActualBalanceRepository = $accountActualBalanceRepository;
    }

    /**
     * @return void
     */
    public function calculateActualBalance(): void
    {
        $aggregatedBalance = $this->accountBalanceRepository->aggregateBalancePerDay();

        if ($aggregatedBalance === null) {
            return;
        }

        /** @var null|AccountActualBalance $maybeActualAccount */
        $maybeActualAccount = $this->accountActualBalanceRepository->findOneBy([]);

        // Create new row
        if ($maybeActualAccount === null) {
            $actualAccount = new AccountActualBalance(
                $aggregatedBalance->getCredit(),
                $aggregatedBalance->getDebit(),
                $aggregatedBalance->getCreditCount(),
                $aggregatedBalance->getDebitCount()
            );

            $this->entityManager->persist($actualAccount);
            $this->entityManager->flush();
            $this->entityManager->clear();
            return;
        }

        if (
            $maybeActualAccount->getCreditCount() === $aggregatedBalance->getCreditCount() &&
            $maybeActualAccount->getDebitCount() === $aggregatedBalance->getDebitCount()) {
            return;
        }

        // Update Existing
        $maybeActualAccount->setCredit($aggregatedBalance->getCredit());
        $maybeActualAccount->setDebit($aggregatedBalance->getDebit());
        $maybeActualAccount->setCreditCount($aggregatedBalance->getCreditCount());
        $maybeActualAccount->setDebitCount($aggregatedBalance->getDebitCount());

        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * @param DateTimeImmutable $date
     *
     * @return void
     */
    public function calculateBalanceForDate(DateTimeImmutable $date)
    {
        $aggregateTransactionBalanceForDate = $this->accountTransactionRepository->getAggregatedBalanceForDate($date);

        if ($aggregateTransactionBalanceForDate === null) {
            return;
        }

        /** @var AggregatedBalance|null $aggregatedBalance */
        $aggregatedBalance = $this->accountBalanceRepository->findOneBy(['date' => $date]);

        // Crete new one
        if ($aggregatedBalance === null) {
            $newAggregateBalance = new AccountBalance(
                $aggregateTransactionBalanceForDate->getDate(),
                $aggregateTransactionBalanceForDate->getCredit(),
                $aggregateTransactionBalanceForDate->getDebit(),
                $aggregateTransactionBalanceForDate->getCreditCount(),
                $aggregateTransactionBalanceForDate->getDebitCount()
            );

            $this->entityManager->persist($newAggregateBalance);
            $this->entityManager->flush();
            $this->entityManager->clear();
            return;
        }

        // Update old one only if neccesary
        if (
            $aggregateTransactionBalanceForDate->getDebitCount() === $aggregatedBalance->getDebitCount() &&
            $aggregateTransactionBalanceForDate->getCreditCount() === $aggregatedBalance->getCreditCount()
        ) {
            return;
        }

        $aggregatedBalance->setCredit($aggregateTransactionBalanceForDate->getCredit());
        $aggregatedBalance->setDebit($aggregateTransactionBalanceForDate->getDebit());
        $aggregatedBalance->setCreditCount($aggregateTransactionBalanceForDate->getCreditCount());
        $aggregatedBalance->setDebitCount($aggregateTransactionBalanceForDate->getDebitCount());

        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function downloadTransactions(): array
    {
        $statement = $this->downloader->downloadReport();
        $transactions = $statement->getTransactionList()->getTransaction();

        $downloadedDates = [];
        foreach ($transactions as $transaction) {
            if (!array_keys($downloadedDates, $transaction->getDate())) {
                $downloadedDates[] = $transaction->getDate();
            }

            $accountTransaction = new AccountTransaction(
                $transaction->getDate(),
                $transaction->getAmount() >= 0 ? $transaction->getAmount() : 0,
                $transaction->getAmount() < 0 ? ($transaction->getAmount() * -1) : 0,
                $transaction->getTransactionId(),
                $transaction->getExecutionId()
            );
            $this->entityManager->persist($accountTransaction);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        return $downloadedDates;
    }
}
