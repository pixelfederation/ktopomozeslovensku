<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service\DonationsImport;

use App\Entity\Donation;
use App\Entity\DonationImport;
use App\Entity\Recipient;
use App\Entity\RecipientGroup;
use App\Service\AccentsRemover;
use Aspera\Spreadsheet\XLSX\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;
use Throwable;

/**
 */
final class Importer
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $recipients;

    /**
     * @var EntityRepository
     */
    private $recipientGroups;

    /**
     * @var Recipient[]
     */
    private $tempRecipients = [];

    /**
     * @param Reader                 $reader
     * @param EntityManagerInterface $em
     */
    public function __construct(Reader $reader, EntityManagerInterface $em)
    {
        $this->reader = $reader;
        $this->em = $em;
        $this->recipients = $this->em->getRepository(Recipient::class);
        $this->recipientGroups = $this->em->getRepository(RecipientGroup::class);
    }

    /**
     * @param DonationImport $import
     *
     * @throws Exception
     */
    public function import(DonationImport $import): void
    {
        try {
            $this->reader->open($import->getImportFile()->getRealPath());
            $this->importRows($import);
            $import->setWasSuccessful(true);
            $this->em->flush();
        } catch (Throwable $e) {
            $this->em->clear();
            $import = $this->em->merge($import);
            $item = $this->em->merge($import->getDonationItem());
            $this->em->refresh($import);
            $this->em->refresh($item);
            $import->setErrorMessage($e->getMessage());
            $this->em->persist($import);
            $this->em->flush();
        } finally {
            $this->reader->close();
        }
    }

    /**
     * @param DonationImport $import
     *
     * @throws Exception
     */
    private function importRows(DonationImport $import): void
    {
        foreach ($this->reader as $row) {
            if (!trim($row[0]) && !trim($row[1]) && !trim($row[2]) && !trim($row[3])) {
                return;
            }

            $recipientName = sprintf("%s, %s", trim($row[1]), trim($row[2]));
            $recipient = $this->resolveRecipient($recipientName, $row[0]);

            $donation = new Donation();
            $donation->setRecipient($recipient);
            $donation->setDonationItem($import->getDonationItem());
            $donation->setDonatedAt($import->getDonatedAt());
            $donation->setCount((int) trim($row[3]));
            $this->em->persist($donation);
        }
    }

    /**
     * @param string $recipientName
     * @param string $recipientGroupName
     *
     * @return Recipient
     * @throws Exception
     */
    private function resolveRecipient(string $recipientName, string $recipientGroupName): Recipient
    {
        $recipientName = trim($recipientName);
        $index = AccentsRemover::removeAccents($recipientName);

        if (isset($this->tempRecipients[$index])) {
            return $this->tempRecipients[$index];
        }

        $recipient = $this->recipients->findOneBy([
            'institutionNameSearchable' => $index
        ]);

        if (!$recipient) {
            $recipientGroup = $this->resolveRecipientGroup($recipientGroupName);
            $this->tempRecipients[$index] = $recipient = new Recipient();
            $recipient->setInstitutionName($recipientName);
            $recipient->setRecipientGroup($recipientGroup);
        }

        return $recipient;
    }

    /**
     * @param string $recipientGroupName
     *
     * @return RecipientGroup
     * @throws Exception
     */
    private function resolveRecipientGroup(string $recipientGroupName): RecipientGroup
    {
        if (!preg_match('/^([A-Z]{1,3})/', $recipientGroupName, $matches)) {
            throw new Exception(sprintf('Unable to find recipient type in \'%s\'.', $recipientGroupName));
        }

        $recipientGroupName = trim($matches[0]);
        $recipientGroup = $this->recipientGroups->findOneBy(['abbreviation' => $recipientGroupName]);

        if (!$recipientGroup || !$recipientGroup instanceof RecipientGroup) {
            throw new Exception(sprintf('Unknown recipient group: %s', $recipientGroupName));
        }

        return $recipientGroup;
    }
}
