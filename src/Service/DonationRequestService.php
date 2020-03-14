<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\DonationRequest;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
final class DonationRequestService
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
     * @param DonationRequest $request
     *
     * @return void
     */
    public function save(DonationRequest $request): void
    {
        $this->entityManager->persist($request);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}
