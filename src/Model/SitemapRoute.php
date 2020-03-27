<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Model;

/**
 *
 */
final class SitemapRoute
{
    /**
     * @var string
     */
    private $route;

    /**
     * @param string $route
     *
     */
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }
}
