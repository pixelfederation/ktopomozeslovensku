<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\TransparentAccountReporterService;
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
     * @param Twig                              $twig
     * @param TransparentAccountReporterService $reporterService
     */
    public function __construct(Twig $twig, TransparentAccountReporterService $reporterService)
    {
        $this->twig = $twig;
        $this->reporterService = $reporterService;
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

        return new Response($this->twig->render('home.html.twig', ['donatedAmount' => $donatedAmount]));
    }
}
