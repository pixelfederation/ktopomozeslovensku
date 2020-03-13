<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Service\HelpRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;

/**
 *
 */
final class HelpRequestController extends AbstractController
{
    /**
     * @var HelpRequestService
     */
    private $service;

    /**
     * @var Twig
     */
    private $twig;

    /**
     * @param Twig $twig
     */
    public function __construct(HelpRequestService $service, Twig $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        return new Response('help');
    }

    /**
     * @return Response
     */
    public function submit(): Response
    {

    }
}
