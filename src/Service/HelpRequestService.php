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
     * @var Mailer
     */
    private $mailer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Mailer                 $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    /**
     * @param HelpRequest $request
     *
     * @return void
     */
    public function save(HelpRequest $request): void
    {
        $this->entityManager->persist($request);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $this->mailer->sendMail(
            'Bola pridaná nová požiadavka o pomoc.',
                "Názov nemocnice / zariadenia / organizácie: {$request->getInstitutionName()}" . PHP_EOL
                . "Adresa nemocnice / zariadenia / organizácie: {$request->getAddress()}" . PHP_EOL
                . "Meno kontaktnej osoby: {$request->getContactPerson()}" . PHP_EOL
                . "Telefónne číslo: {$request->getTelephone()}" . PHP_EOL
                . "E-mail adresa: {$request->getEmail()}" . PHP_EOL
                . "Potrebujeme: {$request->getRequestText()}" . PHP_EOL
            );
    }
}
