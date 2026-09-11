<?php

namespace App\Form;

use App\Entity\Salle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FilmSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $filmGenres = $options['genres'];//Je recupère les genres depuis mon controller
        $builder
            ->add('titre', TextType::class, [
                'required' => false,
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => array_combine($filmGenres,$filmGenres),
                'required' => false,
            ])
            ->add('dateSeance', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('salle', EntityType::class, [
                'class' => Salle::class,
                'choice_label' => 'nom',
                'choice_value' => 'numero',
                'required' => false,
            ]);
    }
    /* fonction pour retirer les accolades dans l'url pour qu'elle soit plus propre */
    public function getBlockPrefix(): string
    {
        return '';
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            /* le token apparaissait dans l'url, je le passe en false pour que ce ne soit plus le cas  */
            'csrf_protection' => false,
            'genres' => [],//Je définis les genres vide par défaut au cas ou pour ne pas avoir d'erreur si rien ne m'est retourné
        ]);
    }
}
