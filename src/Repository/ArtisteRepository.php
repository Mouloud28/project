<?php

namespace App\Repository;

use App\Entity\Search;
use App\Entity\Artiste;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Void_;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Artiste>
 *
 * @method Artiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artiste[]    findAll()
 * @method Artiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

    //    /**
    //     * @return Artiste[] Returns an array of Artiste objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Artiste
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    /**
     * Get published artists thanks to Search value.
     * 
     * @param Search $search
     * @return PaginationInterface
     */

    public function findBySearch(Search $search)
    {

        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.nom LIKE :nom')
            ->setParameter('nom', "%{$search->getSearch()}%")
            ->addOrderBy('a.updatedAt', 'DESC');
        // Utilisation de la variable locale $results pour stocker les résultats
        return $queryBuilder -> getQuery() -> getResult();
    }

    // public function findBySearch(Search $search): PaginationInterface
    // {

    //     $data = $this->createQueryBuilder('a')
    //         ->where('a.nom LIKE :nom')
    //         ->setParameter('nom', '%STATE_PUBLISHED%')
    //         ->addOrderBy('a.updatedAt', 'DESC');

    //     if (!empty($search->getSearch())) {
    //         $data = $data
    //             ->andWhere('a.nom LIKE :search')
    //             ->setParameter('search', "%{$search->getSearch()}%");
    //     }

    //     $data = $data;
    //     $query = $queryBuilder->getQuery();
    //         $results = $query->getResult();

    //     $page = $search->page;
    //     $perPage = 10; // Nombre d'éléments par page

    //     // Calcul de l'offset
    //     $offset = ($page - 1) * $perPage;

    //     // Extraction des résultats pour la page actuelle
    //     $paginatedResults = array_slice($results, $offset, $perPage);

    //     return $paginatedResults;
    // }
}
