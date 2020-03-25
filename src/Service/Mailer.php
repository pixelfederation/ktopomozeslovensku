<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service;

use App\Entity\FormEmail;
use Doctrine\ORM\EntityRepository;

/**
 */
final class Mailer
{
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $subject
     * @param string $message
     */
    public function sendMail(string $subject, string $message): void
    {
        /** @var array<string> $emails */
        $emails = array_map(static function (FormEmail $formEmail) {
            return $formEmail->getEmail();
        }, $this->repository->findAll());

        foreach ($emails as $email) {
            mail($email, $subject, $message, 'From: web@ktopomozeslovensku.sk');
        }
    }

    /**
     * @param string $subject
     * @param string $message
     * @param string $recipient
     */
    public function sendMailToRecipient(string $subject, string $message, string $recipient): void
    {
        mail($recipient, $subject, $message, 'From: web@ktopomozeslovensku.sk');
    }
}
