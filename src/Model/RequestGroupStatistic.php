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
final class RequestGroupStatistic
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $count;

    /**
     * @param string $name
     * @param int $count
     *
     */
    public function __construct(string $name, int $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
