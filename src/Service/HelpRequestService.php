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

//    /**
//     * @param HelpRequestForm $requestForm
//     *
//     * @return void
//     */
//    public function save(HelpRequestForm $requestForm): void
//    {
//
//
//        exit;
//
//        $entity = $this->buildEntity($requestForm);
//
//        dump($entity);
//        exit;
//        $this->entityManager->persist($entity);
//        $this->entityManager->flush();
//        $this->entityManager->clear();
//
//        exit;
//
//        $this->mailer->sendMail(
//            'Bola pridaná nová požiadavka o pomoc.',
//                "Názov nemocnice / zariadenia / organizácie: {$request->getInstitutionName()}" . PHP_EOL
//                . "Adresa nemocnice / zariadenia / organizácie: {$request->getAddress()}" . PHP_EOL
//                . "Meno kontaktnej osoby: {$request->getContactPerson()}" . PHP_EOL
//                . "Telefónne číslo: {$request->getTelephone()}" . PHP_EOL
//                . "E-mail adresa: {$request->getEmail()}" . PHP_EOL
//                . "Potrebujeme: {$request->getRequestText()}" . PHP_EOL
//        );
//
//        $this->mailer->sendMailToRecipient(
//            "KtoPomôžeSlovensku - žiadosť prijatá",
//            "Ďakujeme, že ste nás kontaktovali. Vašu žiadosť sme zaznamenali a určite Vás budeme v najbližšej dobe kontaktovať
//Vopred ďakujeme za Vašu trpezlivosť.",
//            $request->getEmail()
//        );
//    }
//
//    private function buildRequestedItems(HelpRequest $request, HelpRequestForm $form)
//    {
//        $items = [];
//        // do nothing
//        if ($form->getItems() === null || count($form->getItems()) === 0)  {
//            return new ArrayCollection();
//        }
//
//        $filteredItems = array_filter($form->getItems(), static function (array $item) {
//            return $item['item'] === true;
//        });
//
//        if (count($filteredItems) === 0) {
//            return new ArrayCollection();
//        }
//
//        // handle other
//        if (isset($filteredItems['other'])) {
//            $other = $filteredItems['other'];
//            $new =  new HelpRequestsItems();
//            $new->setHelpRequest($request);
//            $new->setOther($other['description']);
//
//            $items[] = $new;
//            unset($filteredItems['other']);
//        }
//
//        foreach ($filteredItems as $key => $formItem) {
//            /** @var DonationItem $item */
//            $item = $this->repository->find($key);
//            $newItem = new HelpRequestsItems();
//            $newItem->setHelpRequest($request);
//            $newItem->setQuantity((int) $formItem['quantity']);
//            $newItem->setItem($item);
//
//            $items[] = $newItem;
//        }
//
//        return new ArrayCollection($items);
//    }
//
//    /**
//     * @param HelpRequestForm $form
//     *
//     * @return HelpRequest
//     */
//    private function buildEntity(HelpRequestForm $form)
//    {
//        $newHelpRequest = new HelpRequest();
//        $newHelpRequest->setInstitutionName($form->getInstitutionName());
//        $newHelpRequest->setAddress($form->getAddress());
//        $newHelpRequest->setContactPerson($form->getContactPerson());
//        $newHelpRequest->setTelephone($form->getTelephone());
//        $newHelpRequest->setEmail($form->getEmail());
//        $newHelpRequest->setPolicy($form->getPolicy());
//        $newHelpRequest->setRequestedItems($this->buildRequestedItems($newHelpRequest, $form));
//
//
//        return $newHelpRequest;
//    }
}
