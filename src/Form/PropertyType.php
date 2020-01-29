<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class,
                [
                    'choices' => $this->getChoices()
                ])
            ->add('city')
            ->add('address')
            ->add('sold')
            ->add('postal_code')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
            // translation_domain permet d'aller chercher le fichier 'forms.fr.yaml' dans le dossier translation
            // qui contient les traductions pour les labels des formulaires (dans le fichier translation.yaml, penser à mettre
            // en 'fr' pour avoir la traduction en français.

        ]);
    }

    // Méthode qui permet d'afficher les noms des chauffages et non plus sa valeur (1, 2, 3, etc. ...)
    public function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
