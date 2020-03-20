<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\Account\AccountService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 *
 */
final class UpdateAccountBalanceController
{
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * @var string
     */
    private $cronToken;

    /**
     * @param AccountService $accountService
     * @param string $cronToken
     */
    public function __construct(
        AccountService $accountService,
        string $cronToken
    ) {

        $this->accountService = $accountService;
        $this->cronToken = $cronToken;
    }

    /**
     * @param string $cronToken
     *
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(string $cronToken): Response
    {
        if ($this->cronToken !== $cronToken) {
            return new RedirectResponse('/');
        }
        // Download new data
        $downloadedDays = $this->accountService->downloadTransactions();

        // Update data per days
        foreach ($downloadedDays as $downloadedDay) {
            $this->accountService->calculateBalanceForDate($downloadedDay);
        }

        if (count($downloadedDays) !== 0) {
            // Finally, aggregate data
            $this->accountService->calculateActualBalance();
        }

        return Response::create('');
    }
}
