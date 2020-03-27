<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Model\SitemapRoute;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 *
 */
final class SitemapService
{
    private const CONTROLLER_FILTER = '/^App\\\Controller\\\(.*?)Controller::/';

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return array
     */
    public function fetchSitemapRoutes(): array
    {
        return array_map(
            static function (string $route) {
                return new SitemapRoute(
                    $route
                );
            },
            array_keys(
                array_filter(
                    $this->router->getRouteCollection()->all(),
                    static function (Route $route) {
                        $controllerRoute = $route->getDefault('_controller') ?? '';
                        $hideInSiteMapOption = $route->getOption('hide_in_sitemap') ?? false;
                        return (bool) preg_match(self::CONTROLLER_FILTER, $controllerRoute) === true && !$hideInSiteMapOption;
                    }
                )
            )
        );
    }
}
