<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */
namespace App\Service\Presenter\ItemState;

use App\Entity\DonationItem;
use App\Service\Mailer;
use App\Service\Presenter\ItemState\Model\ItemStates;
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
    private $repository;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(DonationItem::class);
    }

    /**
     * @param int|null $limit
     *
     * @return Collection
     */
    public function present(int $limit = null): Collection
    {
        if ($limit !== null){
            //todo: change orderBy to relation field - somehow sum of all helpRequestItem.quantity
            return ItemStates::createFromDonationItems($this->repository->findBy([], ['name' => 'DESC'], $limit));
        }

        return ItemStates::createFromDonationItems($this->repository->findAll());
    }
}
