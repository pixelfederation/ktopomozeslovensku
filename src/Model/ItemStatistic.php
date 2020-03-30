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
final class ItemStatistic
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $donated;

    /**
     * @var int
     */
    private $requested;

    /**
     * @var int
     */
    private $difference;

    /**
     * @param string $name
     * @param int $donated
     * @param int $requested
     * @param int $difference
     */
    public function __construct(string $name, int $requested, int $donated, int $difference)
    {
        $this->name = $name;
        $this->requested = $requested;
        $this->donated = $donated;
        $this->difference = $difference;
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
    public function getDonated(): int
    {
        return $this->donated;
    }

    /**
     * @return int
     */
    public function getRequested(): int
    {
        return $this->requested;
    }

    /**
     * @return int
     */
    public function getDifference(): int
    {
        return $this->difference;
    }
}
