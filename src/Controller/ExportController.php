<?php
declare(strict_types=1);
/*
 * @author pbrecska <pbrecska@pixelfederation.com>
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Controller;

use App\Entity\DonationRequest;
use App\Entity\HelpRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * {comment what interface or class does. This comment is not specifically necessary, but it is recommended.}
 */
final class ExportController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function dopyt(Request $request): Response
    {
        $entity = HelpRequest::class;
        $repository = $this->entityManager->getRepository($entity);
        $donations = $repository->findAll();

        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $content = $serializer->serialize($donations, 'csv',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['createdAt']]);

        return new Response("\xEF\xBB\xBF".$content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="' . sprintf('export-dopyt-%s.csv', date('Ymd_His')) . '"'
        ));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function ponuka(Request $request): Response
    {
        $entity = DonationRequest::class;
        $repository = $this->entityManager->getRepository($entity);
        $donations = $repository->findAll();

        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $content = $serializer->serialize($donations, 'csv',[AbstractNormalizer::IGNORED_ATTRIBUTES => ['created_at']]);

        return new Response("\xEF\xBB\xBF".$content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="' . sprintf('export-ponuka-%s.csv', date('Ymd_His')) . '"'
        ));
    }
}
