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

use App\Service\TransparentAccountReporterService;
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
     * @var TransparentAccountReporterService
     */
    private $reporterService;

    /**
     * @param DonationRequestService $service
     */
    public function __construct(DonationRequestService $service, TransparentAccountReporterService $reporterService)
    {
        $this->service = $service;
        $this->reporterService = $reporterService;
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
            $this->service->save($donationRequest);

            return $this->redirectToRoute('donation_success');
        }

        $donatedAmount = $this->reporterService->getDonatedAmount();

        return $this->render(
            'donation.html.twig',
            [
                'form' => $form->createView(),
                'donatedAmount' => $donatedAmount
            ]
        );
    }

    /**
     * @return Response
     */
    public function finance(Request $request): Response
    {
        return $this->render('donation-finance.html.twig');
    }

    /**
     * @return Response
     */
    public function non_finance(Request $request): Response
    {
        $donationRequest = new DonationRequest();
        $form = $this->createForm(DonationRequestType::class, $donationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var DonationRequest $donationRequest */
            $donationRequest = $form->getData();
            $this->service->save($donationRequest);

            return $this->redirectToRoute('donation_success');
        }

        $donatedAmount = $this->reporterService->getDonatedAmount();

        return $this->render(
            'donation-nonfinance.html.twig',
            [
                'form' => $form->createView(),
                'donatedAmount' => $donatedAmount
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
