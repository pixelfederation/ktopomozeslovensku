<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\TransparentAccountReporterService;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 *
 */
final class HomeController
{
    /**
     * @var Twig
     */
    private $twig;
    /**
     * @var TransparentAccountReporterService
     */
    private $reporterService;
    /**
     * @var EntityRepository
     */
    private $donations;

    /**
     * @param Twig                              $twig
     * @param TransparentAccountReporterService $reporterService
     * @param EntityRepository                  $donations
     */
    public function __construct(
        Twig $twig,
        TransparentAccountReporterService $reporterService,
        EntityRepository $donations
    ) {
        $this->twig = $twig;
        $this->reporterService = $reporterService;
        $this->donations = $donations;
    }

    /**
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(): Response
    {
        $donatedAmount = $this->reporterService->getDonatedAmount();
        $spentAmount = $this->reporterService->getSpentAmount();
        $currentBalance = $this->reporterService->getCurrentBalance();
        $donations = $this->donations->findBy([], ['donatedAt' => 'DESC'], 3);
        $donationsCount = $this->donations->count([]);

        return new Response($this->twig->render(
            'home.html.twig',
            [
                'donatedAmount' => $donatedAmount,
                'spentAmount' => $spentAmount,
                'currentBalance' => $currentBalance,
                'donations' => $donations,
                'donationsCount' => $donationsCount,
            ]
        ));
    }
}
