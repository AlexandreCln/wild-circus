<?php

namespace App\Form;

use App\Entity\Spectacle;
use App\Entity\Town;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpectacleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class)
            ->add('town', TextType::class, ['label' => 'Ville'])
            ->add('room_address', TextType::class, ['label' => 'Adresse'])
            ->add('description', TextareaType::class)
            ->add('picture', TextType::class, ['label' => 'Image'])
            ->add('price', IntegerType::class, ['label' => 'Prix'])
            ->add('places', IntegerType::class, ['label' => 'Nombre de places']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Spectacle::class,
        ]);
    }
}
