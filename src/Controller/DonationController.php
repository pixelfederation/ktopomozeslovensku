<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;


use App\Entity\DonationRequest;
use App\Form\DonationRequestType;

use App\Service\DonationRequestService;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
final class DonationController extends AbstractController
{
    /**
     * @var DonationRequestService
     */
    private $service;

    /**
     * @param DonationRequestService $service
     */
    public function __construct(DonationRequestService $service)
    {
        $this->service = $service;
    }


    /**
     * @return Response
     *
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $donationRequest = new DonationRequest();
        $form = $this->createForm(DonationRequestType::class, $donationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var DonationRequest $donationRequest */
            $donationRequest = $form->getData();
            $donationRequest->setCreatedAt(new DateTimeImmutable());
            $this->service->save($donationRequest);

            return $this->redirectToRoute('donation_success');
        }

        return $this->render(
            'donation.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @return Response
     */
    public function success(): Response
    {
        return $this->render('dontation-success.html.twig');
    }
}
