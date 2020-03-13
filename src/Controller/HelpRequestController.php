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
use App\Service\HelpRequestService;
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
     */
    public function index(Request $request): Response
    {
        $helpRequest = new HelpRequest();
        $form = $this->createForm(HelpRequestType::class, $helpRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var HelpRequest $helpRequest */
            $helpRequest = $form->getData();

            $this->service->save($helpRequest);
        }

        return $this->render(
            'help-request.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
