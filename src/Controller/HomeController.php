<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\DonationItemsStatisticService;
use App\Service\RequestGroupsStatisticService;
use Doctrine\ORM\EntityRepository;
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
     * @var RequestGroupsStatisticService
     */
    private $requestGroupsStatistic;

    /**
     * @var EntityRepository
     */
    private $donations;

    /**
     * HomeController constructor.
     * @param Twig $twig
     * @param DonationItemsStatisticService $itemsStatistic
     * @param RequestGroupsStatisticService $requestGroupsStatistic
     * @param EntityRepository $donations
     */
    public function __construct(
        Twig $twig,
        DonationItemsStatisticService $itemsStatistic,
        RequestGroupsStatisticService $requestGroupsStatistic,
        EntityRepository $donations
    ) {
        $this->twig = $twig;
        $this->itemsStatistic = $itemsStatistic;
        $this->requestGroupsStatistic = $requestGroupsStatistic;
        $this->donations = $donations;
    }

    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        $donations = $this->donations->findBy([], ['donatedAt' => 'DESC'], 5);
        $donationsCount = $this->donations->count([]);

        return new Response($this->twig->render(
            'home.html.twig',
            [
                'donations' => $donations,
                'donationsCount' => $donationsCount,
                'itemState' => $this->itemsStatistic->getStatisticsLimited(5),
                'helpRequestGroups' => $this->requestGroupsStatistic->getStatistics()
            ]
        ));
    }
}
