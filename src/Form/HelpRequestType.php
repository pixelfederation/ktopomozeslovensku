<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Form;

use App\Entity\HelpRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 *
 */
final class HelpRequestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('institutionName', TextType::class, [
            'required' => true,
            'label' => 'Názov nemocnice / zariadenia / organizácie',
            'attr' => [
                'placeholder' => 'Názov'
            ],
            'constraints' => [

            ]
        ]);

        $builder->add('address',  TextType::class, [
            'required' => true,
            'label' => 'Adresa nemocnice / zariadenia / organizácie',
            'attr' => [
                'placeholder' => 'Adresa'
            ],
            'constraints' => [
                new NotBlank()
            ]
        ]);

        $builder->add('contactPerson', TextType::class, [
            'required' => true,
            'label' => 'Kontaktná osoba',
            'attr' => [
                'placeholder' => 'Meno a priezvisko'
            ],
            'constraints' => [
                new NotBlank()
            ]
        ]);

        $builder->add('telephone', TelType::class, [
            'required' => true,
            'label' => 'Telefónne číslo',
            'attr' => [
                'placeholder' => '+421'
            ],
            'constraints' => [
                new NotBlank()
            ]
        ]);

        $builder->add('email', EmailType::class, [
            'required' => true,
            'label' => 'E-mail adresa',
            'attr' => [
                'placeholder' => '@'
            ],
            'constraints' => [
                new Email()
            ]
        ]);

        $builder->add('requestText', TextareaType::class, [
            'required' => true,
            'attr' => [
                'rows' => 7,
                'placeholder' => 'Prosíme napíšte, aký materiál potrebujete a uveďte aj počty kusov.'
            ],
            'label' => 'Potrebujeme',
            'constraints' => [
                new NotBlank()
            ]
        ]);

        $builder->add('policy', CheckboxType::class, [
            'required' => true,
            'value' => 1,
            'label' => 'Súhlasím so spracovaním osobných údajov *',
            'constraints' => [
                new EqualTo(1)
            ]
        ]);

        $builder->add('submit', SubmitType::class, [
                'label' => 'ODOSLAť žiadosť', 'attr' => ['class' => 'btn-default']
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => HelpRequest::class]);
    }
}
