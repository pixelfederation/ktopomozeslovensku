<?php
declare(strict_types=1);

/*
 * @author mfris
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Service;

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
     * @return string
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getDonatedAmount(): string
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://ib.fio.sk/ib/transparent?a=2901467117&f=13.02.2020&t=13.03.2020');

        $content = $response->getContent(false);

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->loadHTML($content);

        $xpath = new DOMXPath($doc);
        $query = "//table[contains(@class, 'table')]/tbody/tr/td[6]";

        $entries = $xpath->query($query);

        if (!$entries || $entries->length === 0) {
            return '0.00 E';
        }

        return trim($entries->item(0)->nodeValue);
    }
}
