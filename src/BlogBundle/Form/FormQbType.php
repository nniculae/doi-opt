<?php

namespace BlogBundle\Form;

use BlogBundle\Entity\Client;
use BlogBundle\Form\EventListener\AddFirstNameFieldSubscriber;
use BlogBundle\Repository\ClientRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;

class FormQbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Clienti', EntityType::class, [
            'class' => Client::class,
            'query_builder' => function (ClientRepository $er) {
                $qb = $er->toBeModified();
                $qb->resetDQLPart('where');


                $qb->andWhere(
                    $qb->expr()->orX(
                        $qb->expr()->eq('c.id', 1),
                        $qb->expr()->eq('c.id', 2),
                        $qb->expr()->eq('c.id', 3)
                    ));
//                $expr = Criteria::expr();
                $criteria = Criteria::create();
                $criteria->orderBy(['c.firstName' => 'DESC']);

                $qb->addCriteria($criteria);
//                $qb->orderBy('c.firstName','ASC');
                return $qb;
            },
            'choice_label' => 'firstName',
            'label' => 'Nume Client',
            'multiple' => true,
            'attr' => [
                'style' => 'height:400px'
            ],
        ]);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            // ... adding the name field if needed
            $client = $event->getData();
            $form = $event->getForm();
//            dump($form->all());
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }
}