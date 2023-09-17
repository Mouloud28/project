<?php

namespace App\Repository;

use App\Entity\RoleArtisteFilm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoleArtisteFilm>
 *
 * @method RoleArtisteFilm|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleArtisteFilm|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleArtisteFilm[]    findAll()
 * @method RoleArtisteFilm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleArtisteFilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoleArtisteFilm::class);
    }

//    /**
//     * @return RoleArtisteFilm[] Returns an array of RoleArtisteFilm objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoleArtisteFilm
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
