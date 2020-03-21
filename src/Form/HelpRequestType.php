<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Form;

use App\Entity\RecipientGroup;
use App\Form\Model\HelpRequestForm;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Collection\RecipientGroupType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
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
    use ItemsFragment;

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

        $builder->add('address', TextType::class, [
            'required' => true,
            'label' => 'Adresa nemocnice / zariadenia / organizácie',
            'attr' => [
                'placeholder' => 'Ulica, PSČ, Mesto'
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

        $builder->add('recipientGroup', EntityType::class, [
            'required' => true,
            'label' => 'Typ inštitúcie',
            'class' => RecipientGroup::class,
            'choice_label' => function (RecipientGroup $recipient) {
                return $recipient->getName();
            },
            'placeholder' => 'Vybrať typ ...',
        ]);

        $this->renderItemsFragment($builder, $this->entityManager);

        $builder->add('policy', CheckboxType::class, [
            'required' => true,
            'value' => 1,
            'label' => 'Súhlasím so spracovaním osobných údajov *',
            'constraints' => [
                new EqualTo(1)
            ]
        ]);

        $builder->add('submit', SubmitType::class, [
                'label' => 'Odoslať žiadosť', 'attr' => ['class' => 'btn-default']
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
        $resolver->setDefaults(['data_class' => HelpRequestForm::class]);
    }
}
