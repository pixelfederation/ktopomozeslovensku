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

/**
 *
 */
final class AboutController
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var EntityRepository
     */
    private $partners;

    /**
     * @param Twig             $twig
     * @param EntityRepository $partners
     */
    public function __construct(Twig $twig, EntityRepository $partners)
    {
        $this->twig = $twig;
        $this->partners = $partners;
    }

    public function index(): Response
    {
        $partners = $this->partners->findBy([], ['donatedAmount' => 'DESC', 'helpedAt' => 'DESC', 'name' => 'ASC']);

        return new Response($this->twig->render(
            'about.html.twig',
                [
                    'partners' => $partners,
                ]
            )
        );
    }
}
