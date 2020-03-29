<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service\DonationsImport;

use App\Entity\DonationImport;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 */
final class NewImportListener
{
    /**
     * @var Importer
     */
    private $importer;

    /**
     * @param Importer $importer
     */
    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    /**
     * @param GenericEvent $event
     */
    public function onEasyadminPostpersist(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        if (!$subject instanceof DonationImport) {
            return;
        }

        $this->importer->import($subject);
    }
}
