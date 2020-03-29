<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Entity;

use App\Service\AccentsRemover;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="recipient",uniqueConstraints={@ORM\UniqueConstraint(name="institution_name_idx", columns={"institution_name"})})
 */
class Recipient
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="institution_name")
     */
    private $institutionName = '';

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="institution_name_searchable")
     */
    private $institutionNameSearchable = '';

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Donation", mappedBy="recipient", cascade={"persist","remove"})
     */
    private $donations;

    /**
     * @var RecipientGroup|null
     * @ORM\ManyToOne(targetEntity="App\Entity\RecipientGroup", inversedBy="recipients")
     * @ORM\JoinColumn(name="recipient_group_id", referencedColumnName="id")
     */
    private $recipientGroup;

    /**
     */
    public function __construct()
    {
        $this->donations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInstitutionName(): string
    {
        return $this->institutionName;
    }

    /**
     * @param string $institutionName
     */
    public function setInstitutionName(string $institutionName): void
    {
        $this->institutionName = $institutionName;
        $this->institutionNameSearchable = AccentsRemover::removeAccents(($institutionName));
    }

    /**
     * @return Collection
     */
    public function getDonations(): Collection
    {
        return $this->donations;
    }

    /**
     * @param Collection $donations
     */
    public function setDonations(Collection $donations): void
    {
        $this->donations = $donations;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->institutionName;
    }

    /**
     * @return RecipientGroup|null
     */
    public function getRecipientGroup()
    {
        return $this->recipientGroup;
    }

    /**
     * @param RecipientGroup $recipientGroup
     *
     * @return void
     */
    public function setRecipientGroup(RecipientGroup $recipientGroup): void
    {
        $this->recipientGroup = $recipientGroup;
    }
}
