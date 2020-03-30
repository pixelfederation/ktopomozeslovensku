<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\DonationItemsStatisticService;
use Symfony\Component\HttpFoundation\Response;
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
     * @var DonationItemsStatisticService
     */
    private $itemsStatistic;

    /**
     * @param Twig $twig
     * @param DonationItemsStatisticService $itemsStatistic
     */
    public function __construct(
        Twig $twig,
        DonationItemsStatisticService $itemsStatistic
    ) {
        $this->twig = $twig;
        $this->itemsStatistic = $itemsStatistic;
    }

    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        return new Response($this->twig->render(
            'home.html.twig',
            [
                'itemState' => $this->itemsStatistic->getStatisticsLimited(5)
            ]
        ));
    }
}
