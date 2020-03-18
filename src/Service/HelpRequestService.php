<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\DonationItem;
use App\Entity\HelpRequest;
use App\Entity\HelpRequestsItems;
use App\Form\Model\HelpRequestForm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 *
 */
final class HelpRequestService
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
     * @param Mailer                 $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(DonationItem::class);
        $this->mailer = $mailer;
    }

    /**
     * @param HelpRequestForm $requestForm
     *
     * @return void
     */
    public function save(HelpRequestForm $requestForm): void
    {
        $entity = $this->buildEntity($requestForm);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->entityManager->clear();


        $this->mailer->sendMail(
            'Bola pridaná nová požiadavka o pomoc.',
                "Názov nemocnice / zariadenia / organizácie: {$entity->getInstitutionName()}" . PHP_EOL
                . "Adresa nemocnice / zariadenia / organizácie: {$entity->getAddress()}" . PHP_EOL
                . "Meno kontaktnej osoby: {$entity->getContactPerson()}" . PHP_EOL
                . "Telefónne číslo: {$entity->getTelephone()}" . PHP_EOL
                . "E-mail adresa: {$entity->getEmail()}" . PHP_EOL
                . 'Potrebujeme: ' . PHP_EOL
                . $this->generateRequestedEmailText($entity) . PHP_EOL
        );

        dump($this->generateRequestedEmailText($entity));

        $this->mailer->sendMailToRecipient(
            'KtoPomôžeSlovensku - žiadosť prijatá',
            'Ďakujeme, že ste nás kontaktovali. Vašu žiadosť sme zaznamenali a určite Vás budeme v najbližšej dobe kontaktovať
Vopred ďakujeme za Vašu trpezlivosť.',
            $entity->getEmail()
        );
    }

    /**
     * @param HelpRequestForm $form
     *
     * @return HelpRequest
     */
    private function buildEntity(HelpRequestForm $form): HelpRequest
    {
        $newHelpRequest = new HelpRequest();
        $newHelpRequest->setInstitutionName($form->getInstitutionName());
        $newHelpRequest->setAddress($form->getAddress());
        $newHelpRequest->setContactPerson($form->getContactPerson());
        $newHelpRequest->setTelephone($form->getTelephone());
        $newHelpRequest->setEmail($form->getEmail());
        $newHelpRequest->setPolicy($form->getPolicy());
        $newHelpRequest->setRequestedItems($this->buildRequestedItems($newHelpRequest, $form));


        return $newHelpRequest;
    }

    /**
     * @param HelpRequest $request
     * @param HelpRequestForm $form
     *
     * @return ArrayCollection
     */
    private function buildRequestedItems(HelpRequest $request, HelpRequestForm $form): ArrayCollection
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
            $new =  new HelpRequestsItems();
            $new->setHelpRequest($request);
            $new->setOther($other['description']);

            $items[] = $new;
            unset($filteredItems['other']);
        }

        // handle other all items
        foreach ($filteredItems as $key => $formItem) {
            /** @var DonationItem $item */
            $item = $this->repository->find($key);
            $newItem = new HelpRequestsItems();
            $newItem->setHelpRequest($request);
            $newItem->setQuantity((int) $formItem['quantity']);
            $newItem->setItem($item);

            $items[] = $newItem;
        }

        return new ArrayCollection($items);
    }

    /**
     * @param HelpRequest $helpRequest
     *
     * @return string
     */
    private function generateRequestedEmailText(HelpRequest $helpRequest): string
    {
        $requests = $helpRequest->getRequestedItems()->map(static function (HelpRequestsItems $item) {
            return sprintf('- %s', (string) $item);
        })->toArray();

        return implode(PHP_EOL, $requests );
    }
}
