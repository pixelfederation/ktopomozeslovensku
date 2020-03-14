<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service;

/**
 */
final class Mailer
{

    /**
     * @var array<string>
     */
    private static $emails = [
        'simon@ktopomozeslovensku.sk',
        'zuzana@ktopomozeslovensku.sk',
        'podpora@ktopomozeslovensku.sk',
        'lucia@ktopomozeslovensku.sk',
    ];

    /**
     * @param string $subject
     * @param string $message
     */
    public function sendMail(string $subject, string $message): void
    {
        foreach (self::$emails as $email) {
            mail($email, $subject, $message, 'From: web@ktopomozeslovensku.sk');
        }
    }
}
