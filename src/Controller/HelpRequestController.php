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
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
     * @var Twig
     */
    private $twig;

    /**
     * @param Twig $twig
     */
    public function __construct(HelpRequestService $service, Twig $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }

    /**
     * @return Response
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): Response
    {
        $helpRequest = new HelpRequest();
        $form = $this->createForm(HelpRequestType::class, $helpRequest);

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
    public function submit(Request $request): Response
    {
        dump($request);
        exit;
    }
}
