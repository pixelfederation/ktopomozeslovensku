<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 *
 */
final class RecipientsController
{
    /**
     * @var Twig
     */
    private $twig;
    /**
     * @var EntityRepository
     */
    private $donations;

    /**
     * @param EntityRepository $donations
     * @param Twig             $twig
     */
    public function __construct(EntityRepository $donations, Twig $twig)
    {
        $this->twig = $twig;
        $this->donations = $donations;
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
        $donations = $this->donations->findBy([], ['donatedAt' => 'DESC']);

        return new Response($this->twig->render(
            'recipients.html.twig', [
                'donations' => $donations
            ]
        ));
    }
}
