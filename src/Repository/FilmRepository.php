<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Film>
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    //J'ai fait le choix d'une seul fonction qui s'auto alimente selon les paramètre en url plutot que 
    //plusieur sous fonction, je trouvais sa plus propre niveau du code et plus condensé
    public function findBySearchCriteria(?array $criteria = [], int $page = 1, int $limit = 12): Paginator
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
            $qb->andWhere('f.titre LIKE :titre')
                ->setParameter('titre', '%' . $criteria['titre'] . '%');
        }
        if (!empty($criteria['dateSeance'])) {
            $qb->andWhere('DATE(s.dateHeure) = :dateSeance')
                ->setParameter('dateSeance', $criteria['dateSeance']->format('Y-m-d'));
        }
        if (!empty($criteria['salle'])) {
            $qb->andWhere('sa = :salle')
                ->setParameter('salle', $criteria['salle']);
        }
        $query = $qb->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery();

        return new Paginator($query, true);
    }
    //Fonction pour trouver tout les genres de film distinct, pour qu'ils soient toujours a jour avec les films dispo, 
    //et pas une liste alimenté manuellement
    public function findDistinctGenres(): array
    {
        $resultats = $this->createQueryBuilder('f')
            ->select('DISTINCT f.genre')
            ->where('f.genre IS NOT NULL')
            ->orderBy('f.genre', 'ASC')
            ->getQuery()
            ->getScalarResult();
        return array_column($resultats, 'genre');
    }
}
