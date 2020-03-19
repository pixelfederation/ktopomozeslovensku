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
        $data = $this->entityManager->getRepository(HelpRequest::class)->findAll();

        $encoders = [new CsvEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        $content = $serializer->serialize($data, 'csv', [
//            AbstractNormalizer::GROUPS => ['dopyt'],
            AbstractNormalizer::ATTRIBUTES => [
                'id',
                'telephone',
//                'createdAt' => ['timezone' => ['transitions' => [1 => ['time']]]]
                'institutionName',
                'contactPerson',
                'telephone',
                'email',
                'address',
                'requestedItems' => ['item' => ['name'], 'quantity'],
                'requestedText',
                'resolved'
                ]
        ]);

        return new Response("\xEF\xBB\xBF".$content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="' . sprintf('export-dopyt-%s.csv', date('Ymd_His')) . '"',
            'Cache-Control' =>  'no-cache',
        ));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function ponuka(Request $request): Response
    {
        $data = $this->entityManager->getRepository(DonationRequest::class)->findAll();

        $encoders = [new CsvEncoder()];
        $defaultContext = [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['createdAt', 'requests']
        ];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $serializer = new Serializer($normalizers, $encoders);
        $content = $serializer->serialize($data, 'csv', [
            AbstractNormalizer::IGNORED_ATTRIBUTES => [
                'createdAt',
                'requests',
                '__initializer__',
                '__cloner__',
                '__isInitialized__',
                'policy'
            ]
        ]);

        return new Response("\xEF\xBB\xBF".$content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="' . sprintf('export-ponuka-%s.csv', date('Ymd_His')) . '"',
            'Cache-Control' =>  'no-cache'
        ));
    }
}
