<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\Presenter\ItemState\ItemStatePresenter;
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
     * @var ItemStatePresenter
     */
    private $itemStatePresenter;

    /**
     * @param Twig                              $twig
     * @param TransparentAccountReporterService $reporterService
     * @param ItemStatePresenter $itemStatePresenter
     */
    public function __construct(
        Twig $twig,
        TransparentAccountReporterService $reporterService,
        ItemStatePresenter $itemStatePresenter
    ) {
        $this->twig = $twig;
        $this->reporterService = $reporterService;
        $this->itemStatePresenter = $itemStatePresenter;
    }


    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        $accountAmounts = $this->reporterService->getAmounts();

        return new Response($this->twig->render(
            'home.html.twig',
            [
                'accountAmounts' => $accountAmounts,
                'itemState' => $this->itemStatePresenter->present(5),
            ]
        ));
    }
}
