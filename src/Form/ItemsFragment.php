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
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;

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

        $builder->add('items', CollectionType::class, ['required' => true, 'constraints' => [new All(new NotBlank())]]);

        // Add dynamic fields
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
                                'class' => 'input--small',
                                'placeholder' => 'Aké ?'
                            ]
                        ]
                    )
                    ->getForm()
            );
        });

        // Filter all non submitted choices
        $builder->addEventListener(FormEvents::PRE_SUBMIT, static function (FormEvent $event) {
            /** @var array $form */
            $form = $event->getData();

            if (!isset($form['items']) || count($form['items']) === 0) {
                return;
            }

            $filterEmptyItems = array_filter($form['items'], static function (array $item) {
                return (array_key_exists('item', $item) && $item['item'] === 'on');
            });

            if (count($filterEmptyItems) === 0) {
                $form['items'] = null;
                $event->setData($form);
                return;
            }

            $form['items'] = $filterEmptyItems;
            $event->setData($form);
        });
    }
}
