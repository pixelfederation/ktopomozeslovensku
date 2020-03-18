<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\DonationItem;
use App\Entity\DonationRequest;
use App\Entity\DonationRequestsItems;
use App\Form\Model\DonationRequestForm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 *
 */
final class DonationRequestService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Mailer $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(DonationItem::class);
        $this->mailer = $mailer;
    }

    /**
     * @param DonationRequestForm $requestForm
     *
     * @return void
     */
    public function save(DonationRequestForm $requestForm): void
    {
        $entity = $this->buildEntity($requestForm);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $this->mailer->sendMail('Bol prijatý nový dar.',
            "Meno kontaktnej osoby: {$entity->getContactPerson()}" . PHP_EOL
            . "Adresa konktaktnej osoby: {$entity->getAddress()}" . PHP_EOL
            . "Telefónne číslo: {$entity->getTelephone()}" . PHP_EOL
            . "E-mail adresa: {$entity->getEmail()}" . PHP_EOL
            . 'Darujeme: ' . PHP_EOL
            . $this->generateRequestedEmailText($entity) . PHP_EOL
        );
    }

    /**
     * @param DonationRequestForm $form
     *
     * @return DonationRequest
     */
    private function buildEntity(DonationRequestForm $form): DonationRequest
    {
        $newDonationRequest = new DonationRequest();

        $newDonationRequest->setAddress($form->getAddress());
        $newDonationRequest->setContactPerson($form->getContactPerson());
        $newDonationRequest->setTelephone($form->getTelephone());
        $newDonationRequest->setEmail($form->getEmail());
        $newDonationRequest->setPolicy($form->getPolicy());
        $newDonationRequest->setDonatedItems($this->buildRequestedItems($newDonationRequest, $form));

        return $newDonationRequest;
    }

    /**
     * @param DonationRequest $request
     * @param DonationRequestForm $form
     *
     * @return ArrayCollection
     */
    private function buildRequestedItems(DonationRequest $request, DonationRequestForm $form): ArrayCollection
    {
        $items = [];
        // do nothing
        if ($form->getItems() === null || count($form->getItems()) === 0)  {
            return new ArrayCollection();
        }

        $filteredItems = array_filter($form->getItems(), static function (array $item) {
            return $item['item'] === true;
        });

        if (count($filteredItems) === 0) {
            return new ArrayCollection();
        }

        // handle other
        if (isset($filteredItems['other'])) {
            $other = $filteredItems['other'];
            $new =  new DonationRequestsItems();
            $new->setDonationRequest($request);
            $new->setOther($other['description']);

            $items[] = $new;
            unset($filteredItems['other']);
        }

        // handle other all items
        foreach ($filteredItems as $key => $formItem) {
            /** @var DonationItem $item */
            $item = $this->repository->find($key);
            $newItem = new DonationRequestsItems();
            $newItem->setDonationRequest($request);
            $newItem->setQuantity((int) $formItem['quantity']);
            $newItem->setItem($item);

            $items[] = $newItem;
        }

        return new ArrayCollection($items);
    }

    /**
     * @param DonationRequest $helpRequest
     *
     * @return string
     */
    private function generateRequestedEmailText(DonationRequest $helpRequest): string
    {
        $requests = $helpRequest->getDonatedItems()->map(static function (DonationRequestsItems $item) {
            return sprintf('- %s', (string) $item);
        })->toArray();

        return implode(PHP_EOL, $requests );
    }
}
