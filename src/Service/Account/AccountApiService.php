<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service\Account;

use App\Service\Account\Exception\TryAgainLater;
use App\Service\Account\Exception\UnableToDownloadAccountStatement;
use App\Service\Account\Model\AccountStatement;
use App\Service\Account\Model\Data;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 *
 */
final class AccountApiService
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $fioApiUrl;

    /**
     * @var string
     */
    private $fioApiToken;

    /**
     * @param SerializerInterface $serializer
     * @param string $fioApiUrl
     * @param string $fioApiToken
     */
    public function __construct(
        SerializerInterface $serializer,
        string $fioApiUrl,
        string $fioApiToken
    ) {
        $this->serializer = $serializer;
        $this->fioApiUrl = $fioApiUrl;
        $this->fioApiToken = $fioApiToken;
    }

    /**
     *
     * @return AccountStatement
     *
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function downloadReport(): AccountStatement
    {
        $client = HttpClient::createForBaseUri($this->fioApiUrl);
        $response = $client->request('GET', sprintf('last/%s/transactions.json', $this->fioApiToken));

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new UnableToDownloadAccountStatement('Unable to download last data from FIO.');
        }

        if ($response->getStatusCode() === Response::HTTP_CONFLICT) {
            throw new TryAgainLater('There is conflict on requested entity please try again later.');
        }

        /** @var Data $data */
        $data = $this->serializer->deserialize(
            $response->getContent(true),
            Data::class,
            'json'
        );

        return $data->getAccountStatement();
    }

    /**
     * @param string $date
     *
     * @return bool
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function resetReportMark(string $date): bool
    {
        $client = HttpClient::createForBaseUri($this->fioApiUrl);
        $response = $client->request('GET', sprintf('set-last-date/%s/%s/', $this->fioApiToken, $date));

        return $response->getContent(true) === '';
    }
}
