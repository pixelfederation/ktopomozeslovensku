<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Model\SitemapRoute;
use App\Service\SitemapService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 *
 */
final class SitemapController
{
    /**
     * @var SitemapService
     */
    private $sitemapService;

    /**
     * @var Twig
     */
    private $twig;

    /**
     * @param Twig $twig
     * @param SitemapService $sitemapService
     */
    public function __construct(
        Twig $twig,
        SitemapService $sitemapService
    ) {
        $this->sitemapService = $sitemapService;
        $this->twig = $twig;
    }

    /**
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        /** @var array<SitemapRoute> $routes */
        $routes = $this->sitemapService->fetchSitemapRoutes();

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/xml');
        $response->setContent($this->twig->render('sitemap.html.twig', ['urls' => $routes]));

        return $response;
    }
}
