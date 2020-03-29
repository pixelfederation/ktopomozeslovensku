<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Presenter\ItemState;

use App\Entity\DonationItem;
use App\Entity\HelpRequestsItems;
use App\Service\Presenter\ItemState\Model\ItemState;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Presents to frontend how many of which items are dispatched or in need
 */
final class ItemStatePresenter
{
    /**
     * @var ObjectRepository
     */
    private $Donationrepository;

    /**
     * @var ObjectRepository
     */
    private $HelpRreqItemrepository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->Donationrepository = $entityManager->getRepository(DonationItem::class);
        $this->HelpRreqItemrepository = $entityManager->getRepository(HelpRequestsItems::class);
    }

    /**
     * @param int|null $limit
     *
     * @return Collection
     */
    public function present(int $limit = null): Collection
    {
        if ($limit !== null) {
            //todo: change orderBy to relation field - somehow sum of all helpRequestItem.quantity
            $result = new ArrayCollection($this->Donationrepository->findBy([], ['name' => 'DESC'], $limit));
            return $result->map(function (DonationItem $don) {
                $state = new ItemState($don);
                $rqeuests = $this->HelpRreqItemrepository->getItemCounts($state->getItemId());
                $state->setRequested($rqeuests);
                return $state;
            });
        }

        $result = new ArrayCollection($this->Donationrepository->findBy([], ['name' => 'DESC']));
        return $result->map(function (DonationItem $don) {
            $state = new ItemState($don);
            $rqeuests = $this->HelpRreqItemrepository->getItemCounts($state->getItemId());
            $state->setRequested($rqeuests);
            return $state;
        });
    }
}
