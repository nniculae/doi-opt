<?php

namespace BlogBundle\Form;

use BlogBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Form2Type extends AbstractType
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Form2Type constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         dump($this->tokenStorage->getToken());
        $builder->add('firstName');
        // grab the user, do a quick sanity check that one exists
        $user = $this->tokenStorage->getToken()->getUser();
//        $this->tokenStorage->getToken()->


        if (!$user) {
            throw new \LogicException(
                'The FriendMessageFormType cannot be used without an authenticated user!'
            );
        }

        if($user === "anon."){
            $builder->add('MOCOFANII');
        }

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($user) {

            $form = $event->getForm();
            if($user === "anon."){
                $form->add('lastName');
            }

            //            if (null !== $event->getData()->getFriend()) {
//                // we don't need to add the friend field because
//                // the message will be addressed to a fixed friend
//                return;
//            }
//
//            $form = $event->getForm();
//
//            $formOptions = array(
//                'class' => User::class,
//                'choice_label' => 'fullName',
//                'query_builder' => function (UserRepository $userRepository) use ($user) {
//                    // call a method on your repository that returns the query builder
//                    // return $userRepository->createFriendsQueryBuilder($user);
//                },
//            );
//
//            // create the field, this is similar the $builder->add()
//            // field name, field type, field options
//            $form->add('friend', EntityType::class, $formOptions);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }
}