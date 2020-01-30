<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                    'attr' => ['placeholder' => 'Prénom']
                ])
            ->add('lastname',
                TextType::class,
                [
                    'attr' => ['placeholder' => 'Nom']
                ])
            ->add('email',
                EmailType::class,
                [
                    'attr' => ['placeholder' => 'Email']
                ])
            ->add('plainPassword',
                RepeatedType::class,
                [
                'type' => PasswordType::class,
                    'first_options' => ['attr' => ['placeholder' => 'Mot de passe']],
                    'second_options' => ['attr' => ['placeholder' => 'Confirmation du mot de passe']],
                    'invalid_message' => 'Les mots de passe ne sont pas identiques'
                ])
            ->add('postalcode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
