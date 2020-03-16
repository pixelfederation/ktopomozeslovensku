<?php
declare(strict_types=1);
/*
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 * @license    Internal use only
 */

namespace App\Form;

use App\Entity\Donation;
use App\Entity\Recipient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 */
final class DonationType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donation::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recipient', EntityType::class, [
                'class' => Recipient::class,
                'choice_value' => function (?Recipient $entity) {
                    return $entity ? $entity->getId() : '';
                }
            ])
            ->add('donationItem')
            ->add('count')
            ->add('donatedAt');;
    }
}
