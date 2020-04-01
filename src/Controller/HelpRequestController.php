<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Entity\HelpRequest;
use App\Form\HelpRequestType;
use App\Form\Model\HelpRequestForm;
use App\Service\HelpRequestService;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
final class HelpRequestController extends AbstractController
{
    /**
     * @var HelpRequestService
     */
    private $service;

    /**
     * @param HelpRequestService $service
     */
    public function __construct(HelpRequestService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $helpRequest = new HelpRequestForm();
        $form = $this->createForm(HelpRequestType::class, $helpRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var HelpRequestForm $helpRequest */
            $helpRequest = $form->getData();
            $this->service->save($helpRequest);
            return $this->redirectToRoute('help_request_success');
        }

        return $this->render(
            'help-request.html.twig',
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
        return $this->render('help-request-success.twig');
    }
}
