<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service\DonationsImport\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class FileAlreadyUploaded extends Constraint
{
    public $message = 'The file "{{ string }}" was already uploaded.';
}
