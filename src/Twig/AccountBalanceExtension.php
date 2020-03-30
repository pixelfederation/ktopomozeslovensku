<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Twig;

use App\Model\AccountReport;
use App\Service\TransparentAccountReporterService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 *
 */
final class AccountBalanceExtension extends AbstractExtension
{
    /**
     * @var TransparentAccountReporterService
     */
    private $accountReporterService;

    /**
     * @var AccountReport|null
     */
    private $accountReport;

    /**
     * @param TransparentAccountReporterService $accountReporterService
     */
    public function __construct(TransparentAccountReporterService $accountReporterService)
    {
        $this->accountReporterService = $accountReporterService;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('account_credit', [$this, 'getCreditValue']),
            new TwigFunction('account_debit', [$this, 'getDebitValue']),
            new TwigFunction('account_balance', [$this, 'getBalanceValue'])
        ];
    }

    /**
     * @return float
     */
    public function getCreditValue(): float
    {
        return $this->getReport()->getCredit();
    }

    /**
     * @return float
     */
    public function getDebitValue(): float
    {
        return $this->getReport()->getDebit();
    }

    /**
     * @return float
     */
    public function getBalanceValue(): float
    {
        return $this->getReport()->getBalance();
    }

    /**
     * @return AccountReport
     */
    private function getReport(): AccountReport
    {
        if ($this->accountReport === null) {
            $this->accountReport = $this->accountReporterService->getAccountReport();
        }

        return $this->accountReport;
    }
}
