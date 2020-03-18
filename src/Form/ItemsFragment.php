<?php
declare(strict_types=1);

/*
 * @author tmihalicka
 * @copyright PIXEL FEDERATION
 * @license Internal use only
 */

namespace App\Form;

use App\Entity\DonationItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 *
 */
trait ItemsFragment
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param EntityManagerInterface $entityManager
     * @return void
     */
    protected function renderItemsFragment(FormBuilderInterface $builder, EntityManagerInterface $entityManager): void
    {
        $repository = $entityManager->getRepository(DonationItem::class);

        $builder->add('items', CollectionType::class, [
            'required' => true,
        ]);
        $builder->addEventListener(FormEvents::POST_SET_DATA, static function (FormEvent $event) use ($builder, $repository) {
            $form = $event->getForm();
            /** @var DonationItem $item */
            foreach ($repository->findAll() as $item) {
                $form->get('items')
                    ->add(
                        $builder->create(sprintf('%s', $item->getId()),
                            FormType::class,
                            [
                                'by_reference' => false,
                                'auto_initialize' => false
                            ]
                        )
                            ->add(
                                'item',
                                CheckboxType::class,
                                [
                                    'required' => false,
                                    'label' => $item->getName()
                                ]
                            )
                            ->add(
                                'quantity',
                                NumberType::class,
                                [
                                    'required' => false,
                                    'attr' => [
                                        'class' => 'input--small'
                                    ],
                                    'data' => 0,
                                    'html5' => true
                                ]
                            )
                            ->getForm()
                    );
            }
            $form->get('items')->add(
                $builder->create('other',
                    FormType::class,
                    [
                        'by_reference' => false,
                        'auto_initialize' => false
                    ]
                )
                    ->add(
                        'item',
                        CheckboxType::class,
                        [
                            'required' => false,
                            'label' => 'Iné ...'
                        ]
                    )
                    ->add(
                        'description',
                        TextType::class,
                        [
                            'required' => false,
                            'attr' => [
                                'class' => 'input--small'
                            ]
                        ]
                    )
                    ->getForm()
            );
        });
    }
}
