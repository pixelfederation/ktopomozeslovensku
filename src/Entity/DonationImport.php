<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Entity;

use App\Service\DonationsImport\Validation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTimeImmutable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="donation_import",uniqueConstraints={@ORM\UniqueConstraint(name="import_idx", columns={"import"})})
 * @Vich\Uploadable()
 */
/* final */class DonationImport
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="date_immutable", nullable=false)
     */
    private $donatedAt;

    /**
     * @var DonationItem
     * @ORM\ManyToOne(targetEntity="App\Entity\DonationItem", inversedBy="donations", cascade={"merge","refresh"})
     * @ORM\JoinColumn(name="donation_item_id", referencedColumnName="id", nullable=false)
     */
    private $donationItem;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $import;

    /**
     * @Vich\UploadableField(mapping="donation_imports", fileNameProperty="import")
     * @Validation\FileAlreadyUploaded(groups={"default"})
     * @var File
     */
    private $importFile;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $wasSuccessful = false;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @var string
     */
    private $errorMessage = null;

    /**
     */
    public function __construct()
    {
        $this->donatedAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDonatedAt(): ?DateTimeImmutable
    {
        return $this->donatedAt;
    }

    /**
     * @param DateTimeImmutable $donatedAt
     */
    public function setDonatedAt(DateTimeImmutable $donatedAt): void
    {
        $this->donatedAt = $donatedAt;
    }

    /**
     * @return DonationItem
     */
    public function getDonationItem(): ?DonationItem
    {
        return $this->donationItem;
    }

    /**
     * @param DonationItem $donationItem
     */
    public function setDonationItem(DonationItem $donationItem): void
    {
        $this->donationItem = $donationItem;
    }

    /**
     * @return string
     */
    public function getImport(): ?string
    {
        return $this->import;
    }

    /**
     * @param string $import
     */
    public function setImport(string $import): void
    {
        $this->import = $import;
    }

    /**
     * @return File
     */
    public function getImportFile(): ?File
    {
        return $this->importFile;
    }

    /**
     * @param File $importFile
     */
    public function setImportFile(File $importFile): void
    {
        $this->importFile = $importFile;
    }

    /**
     * @return bool
     */
    public function isWasSuccessful(): bool
    {
        return $this->wasSuccessful;
    }

    /**
     * @param bool $wasSuccessful
     */
    public function setWasSuccessful(bool $wasSuccessful): void
    {
        $this->wasSuccessful = $wasSuccessful;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}
