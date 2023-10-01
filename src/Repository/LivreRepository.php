<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\Search;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
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

        $queryBuilder = $this->createQueryBuilder('l')
            ->where('l.titre_francais LIKE :titre_francais')
            ->setParameter('titre_francais', "%{$search->getSearch()}%")
            ->addOrderBy('l.updatedAt', 'DESC');

        if (!empty($search->getSearch())) {
            $queryBuilder
                ->andWhere('l.titre_francais LIKE :search')
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
