<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Film>
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /*     public function findAllWithSeances(): array
    {
        return $this->createQueryBuilder('f')

            ->leftJoin('f.seances', 's')
            ->addSelect('s')
            ->leftJoin('s.salle', 'sa')
            ->addSelect('sa')
            ->getQuery()
            ->getResult();
    } */

    public function findAllWithSeances(?array $criteria = []): array
    {
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.seances', 's')
            ->addSelect('s')
            ->leftJoin('s.salle', 'sa')
            ->addSelect('sa');
        if (!empty($criteria['genre'])) {
            $qb->andWhere('f.genre = :genre')
                ->setParameter('genre', $criteria['genre']);
        }
        if (!empty($criteria['titre'])) {
            $qb->andWhere('f.titre = :titre')
                ->setParameter('titre', $criteria['titre']);
        }
        if (!empty($criteria['dateSeance'])) {
            $qb->andWhere('s.dateHeure = :dateSeance')
                ->setParameter('dateSeance', $criteria['dateSeance']);
        }
        if(!empty($criteria['salle'])) {
            $qb->andWhere('sa = :salle')
                ->setParameter('salle',$criteria['salle']);
        }
        return $qb->getQuery()
            ->getResult();
    }
//Fonction pour trouver tout les genres de film distinct, pour qu'ils soient toujours a jour avec les films dispo, 
//et pas une liste alimenté manuellement
    public function findDistinctGenres():array 
    {
        $resultats = $this->createQueryBuilder('f')
            ->select('DISTINCT f.genre')
            ->where('f.genre IS NOT NULL')
            ->orderBy('f.genre','ASC')
            ->getQuery()
            ->getScalarResult();
        return array_column($resultats,'genre');
    }
/*     public function findFilmBySalle() {
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.seances', 's')
            ->addSelect('s')
            ->leftJoin('s.salle', 'sa')
            ->addSelect('sa');

    } */
    //    /**
    //     * @return Film[] Returns an array of Film objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Film
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
