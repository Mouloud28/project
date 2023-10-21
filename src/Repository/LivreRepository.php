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
        $queryBuilder = $this->createQueryBuilder('l')
            ->where('l.titre_francais LIKE :titre_francais')
            ->setParameter('titre_francais', "%{$search->getSearch()}%")

            ->join("l.auteur", "a")
            ->orWhere("a.nom LIKE :nom_auteur")
            ->setParameter('nom_auteur', "%{$search->getSearch()}%")

            ->addOrderBy('l.updatedAt', 'DESC');
        return $queryBuilder->getQuery()->getResult();
    }
}
