<?php
declare(strict_types=1);

/*
 * @author mfris
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

use App\Entity\AccountActualBalance;
use App\Repository\AccountActualBalanceRepository;
use DOMDocument;
use DOMXPath;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 *
 */
final class TransparentAccountReporterService
{
    /**
     * @var AccountActualBalanceRepository
     */
    private $repository;

    /**
     * @param AccountActualBalanceRepository $repository
     */
    public function __construct(AccountActualBalanceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * //todo remove this method when all data is populated
     * @return string
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function fallbackToWebCrawler(): string
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://ib.fio.sk/ib/transparent?a=2901467117');

        $content = $response->getContent(false);

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->loadHTML($content);

        $xpath = new DOMXPath($doc);
        $query = "//table[contains(@class, 'table')]/tbody/tr/td[2]";

        $entries = $xpath->query($query);

        if (!$entries || $entries->length === 0) {
            return '0.00 E';
        }

        return trim($entries->item(0)->nodeValue);
    }

    /**
     * @return string
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getDonatedAmount(): string
    {
        return $this->_getResult('getCredit');
    }

    /**
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getSpentAmount(): string
    {
        return $this->_getResult('getDebit');
    }

    /**
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getCurrentBalance(): string
    {
        return $this->_getResult('getBalance');
    }

    /**
     * @param $method
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    private function _getResult($method)
    {
        /** @var AccountActualBalance|null $result */
        $result = $this->repository->findOneBy([]);

        if ($result === null) {
            return $this->fallbackToWebCrawler();
        }

        if (method_exists($result, $method)) {
            return $this->_formatAmount(
                $result->$method()
            );
        }

        return '';
    }

    /**
     * @param $amount
     * @return string
     */
    private function _formatAmount($amount): string
    {
        return sprintf(
            '%s EUR',
            number_format(
                $amount,
                2,
                ',',
                ' '
            )
        );
    }
}
