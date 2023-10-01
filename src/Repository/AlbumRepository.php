<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\Search;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Album>
 *
 * @method Album|null find($id, $lockMode = null, $lockVersion = null)
 * @method Album|null findOneBy(array $criteria, array $orderBy = null)
 * @method Album[]    findAll()
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

//    /**
//     * @return Album[] Returns an array of Album objects
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

//    public function findOneBySomeField($value): ?Album
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
        $results = []; // Initialisation de la variable $results comme un tableau vide

        $queryBuilder = $this->createQueryBuilder('al')
            ->where('al.titre_francais LIKE :titre_francais')
            ->setParameter('titre_francais', "%{$search->getSearch()}%")
            ->addOrderBy('al.updatedAt', 'DESC');

        if (!empty($search->getSearch())) {
            $queryBuilder
                ->andWhere('al.titre_francais LIKE :search')
                ->setParameter('search', "%{$search->getSearch()}%");
        }

        $query = $queryBuilder->getQuery();

        // Utilisation de la variable locale $results pour stocker les résultats
        $results = $query->getResult();

        // Pagination
        $page = $search->getPage();
        $perPage = 10; // Nombre d'éléments par page

        // Calcul de l'offset
        $offset = ($page - 1) * $perPage;

        // Extraction des résultats pour la page actuelle
        $paginatedResults = array_slice($results, $offset, $perPage);

        return $paginatedResults;
    }
}
