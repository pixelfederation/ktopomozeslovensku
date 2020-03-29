<?php
declare(strict_types=1);

/*
 * @author pbrecska
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\Presenter\helpRequestGroup;
use App\Service\Presenter\ItemState\ItemStatePresenter;
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
final class WeHelpedController
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
     * @var EntityRepository
     */
    private $donations;
    /**
     * @var helpRequestGroup
     */
    private $helpRequestGroupPresenter;

    /**
     * @param Twig $twig
     * @param TransparentAccountReporterService $reporterService
     * @param ItemStatePresenter $itemStatePresenter
     * @param helpRequestGroup $helpRequestGroupPresenter
     * @param EntityRepository $donations
     */
    public function __construct(
        Twig $twig,
        TransparentAccountReporterService $reporterService,
        ItemStatePresenter $itemStatePresenter,
        helpRequestGroup $helpRequestGroupPresenter,
        EntityRepository $donations
    ) {
        $this->twig = $twig;
        $this->reporterService = $reporterService;
        $this->itemStatePresenter = $itemStatePresenter;
        $this->donations = $donations;
        $this->helpRequestGroupPresenter = $helpRequestGroupPresenter;
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
        $donations = $this->donations->findBy([], ['donatedAt' => 'DESC'], 10);
        $donationsCount = $this->donations->count([]);

        return new Response($this->twig->render(
            'we-helped.html.twig',
            [
                'donations' => $donations,
                'donationsCount' => $donationsCount,
                'itemState' => $this->itemStatePresenter->present(),
                'helpRequestGroups' => $this->helpRequestGroupPresenter->present(),
            ]
        ));
    }
}
