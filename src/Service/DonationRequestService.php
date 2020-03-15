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
     * @var Mailer
     */
    private $mailer;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
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

        $this->mailer->sendMail('Bol prijatý nový dar.',
            "Meno kontaktnej osoby: {$request->getContactPerson()}" . PHP_EOL
            . "Adresa konktaktnej osoby: {$request->getAddress()}" . PHP_EOL
            . "Telefónne číslo: {$request->getTelephone()}" . PHP_EOL
            . "E-mail adresa: {$request->getEmail()}" . PHP_EOL
            . "Typ pomôcok, ktoré viem ponúknuť: {$request->getDonationItem()->getName()}" . PHP_EOL
            . "Množstvo: {$request->getQuantity()}" . PHP_EOL
        );
    }
}
