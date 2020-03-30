<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Service\DonationsImport\Validation;

use App\Entity\DonationImport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class FileAlreadyUploadedValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof FileAlreadyUploaded) {
            throw new UnexpectedTypeException($constraint, FileAlreadyUploaded::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof UploadedFile) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, UploadedFile::class);
        }

        $import = $this->em->getRepository(DonationImport::class)
            ->findOneBy(['import' => $value->getClientOriginalName()]);

        if ($import) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value->getClientOriginalName())
                ->addViolation();
        }
    }
}

