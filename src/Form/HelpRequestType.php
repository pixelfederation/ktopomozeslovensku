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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ]
        ]);

        $builder->add('contactPerson', TextType::class, [
            'required' => true,
            'label' => 'Meno konktaktnej osoby',
            'attr' => [
                'placeholder' => 'Meno a priezvisko'
            ]
        ]);

        $builder->add('telephone', TextType::class, [
            'required' => true,
            'label' => 'Telefónne číslo'
        ]);

        $builder->add('email', EmailType::class, [
            'required' => true,
            'label' => 'E-mail adresa',
            'attr' => [
                'placeholder' => '@'
            ]
        ]);

        $builder->add('requestText', TextareaType::class, [
            'required' => true,
            'attr' => [
                'rows' => 7
            ]
        ]);

        $builder->add('policy', CheckboxType::class, [
            'required' => true,
            'value' => 1,
            'label' => 'Súhlasím so spracovaním osobných údajov'
        ]);

        $builder->add('submit', SubmitType::class, ['label' => 'ODOSLAť žiadosť o pomoc']);
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
