<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Presenter;

use App\Entity\DonationItem;
use App\Entity\HelpRequestsItems;
use App\Service\Presenter\ItemState\Model\ItemState;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * {comment what interface or class does. This comment is not specifically necessary, but it is recommended.}
 */
final class helpRequestGroup
{
/**
* @var \App\Repository\HelpRequesRepository
     */
    private $HelpRreqItemrepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->HelpRreqItemrepository = $entityManager->getRepository(\App\Entity\HelpRequest::class);
    }

    /**
     * @param int|null $limit
     *
     * @return Collection
     */
    public function present(): Collection
    {
            return new ArrayCollection($this->HelpRreqItemrepository->getCounts());
    }

}
