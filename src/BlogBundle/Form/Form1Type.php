<?php

namespace BlogBundle\Form;

use BlogBundle\Entity\Client;
use BlogBundle\Form\EventListener\AddFirstNameFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;

class Form1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            // ... adding the name field if needed
//            $client = $event->getData();
//            $form = $event->getForm();
//            // add it conditionnaly
//            if (!$client) {
//                $form->add('lastName');
//            }
        });

        $builder->addEventSubscriber(new AddFirstNameFieldSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }
}