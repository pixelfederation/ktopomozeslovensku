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

use App\Form\Model\DonationRequestForm;
use App\Service\TransparentAccountReporterService;
use App\Service\DonationRequestService;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
     * @param TransparentAccountReporterService $reporterService
     */
    public function __construct(
        DonationRequestService $service,
        TransparentAccountReporterService $reporterService
    ) {
        $this->service = $service;
        $this->reporterService = $reporterService;
    }


    /**
     * @return Response
     */
    public function index(): Response
    {
        $accountAmounts = $this->reporterService->getAmounts();

        return $this->render(
            'donation.html.twig',
            [
                'accountAmounts' => $accountAmounts
            ]
        );
    }

    /**
     * @return Response
     */
    public function finance(): Response
    {
        return $this->render('donation-finance.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function nonFinance(Request $request): Response
    {
        $donationRequest = new DonationRequestForm();
        $form = $this->createForm(DonationRequestType::class, $donationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var DonationRequestForm $donationRequest */
            $donationRequest = $form->getData();
            $this->service->save($donationRequest);

            return $this->redirectToRoute('donation_success');
        }

        $accountAmounts = $this->reporterService->getAmounts();

        return $this->render(
            'donation-nonfinance.html.twig',
            [
                'form' => $form->createView(),
                'accountAmounts' => $accountAmounts
            ]
        );
    }

    /**
     * @return Response
     */
    public function success(): Response
    {
        return $this->render('donation-success.html.twig');
    }
}
