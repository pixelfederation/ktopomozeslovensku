<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\HelpRequest;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
final class HelpRequestService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param HelpRequest $request
     *
     * @return void
     */
    public function save(HelpRequest $request): void
    {

    }
}
