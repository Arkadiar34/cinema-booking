<?php
// src/Form/ReservationType.php
namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Film;
use App\Entity\Seance;
use App\Repository\FilmRepository;
use App\Repository\SeanceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('film', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'titre',
                'label' => 'Sélectionnez un film',
                'placeholder' => '-- Choisir un film --',
                'required' => true,
                'query_builder' => function (FilmRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->innerJoin('f.seances', 's')
                        ->where('s.dateHeure > :now')
                        ->setParameter('now', new \DateTime())
                        ->orderBy('f.titre', 'ASC');
                },
                'attr' => ['class' => 'form-select mb-3'],
            ])
            ->add('seance', EntityType::class, [
                'class' => Seance::class,
                'choice_label' => function (Seance $seance) {
                    return $seance->getDateHeure()->format('d/m/Y à H:i')
                        . ' - Salle ' . $seance->getSalle()->getNumero();
                },
                'label' => 'Choisissez une séance',
                'placeholder' => '-- Choisir une séance --',
                'required' => true,
                'query_builder' => function (SeanceRepository $repo) {
                    return $repo->createQueryBuilder('s')
                        ->where('s.dateHeure > :now')
                        ->setParameter('now', new \DateTime())
                        ->orderBy('s.dateHeure', 'ASC');
                },
                'attr' => ['class' => 'form-select mb-3'],
            ])
            ->add('nbPlaces', IntegerType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Ex: 2',
                ],
                'help' => 'Maximum 10 places par réservation',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Indiquez le nombre de places']),
                    new Assert\Positive(['message' => 'Le nombre doit être positif']),
                    new Assert\Range([
                        'min' => 1,
                        'max' => 10,
                        'notInRangeMessage' => 'Réservez entre {{ min }} et {{ max }} places',
                    ]),
                ],
            ])
            ->add('emailClient', EmailType::class, [
                'label' => 'Votre email',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'votre.email@exemple.com',
                ],
                'help' => 'Pour recevoir votre confirmation de réservation',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'L\'email est obligatoire']),
                    new Assert\Email(['message' => 'Format d\'email invalide']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Confirmer la réservation',
                'attr' => ['class' => 'btn btn-primary btn-lg w-100 mt-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
