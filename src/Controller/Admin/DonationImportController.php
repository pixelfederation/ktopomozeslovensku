<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Controller\Admin;

use App\Entity\DonationImport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Vich\UploaderBundle\Handler\DownloadHandler;

/**
 */
final class DonationImportController extends AbstractController
{
    public function downloadImportAction(DonationImport $import, DownloadHandler $downloadHandler): Response
    {
        return $downloadHandler->downloadObject($import, $fileField = 'importFile');
    }
}
