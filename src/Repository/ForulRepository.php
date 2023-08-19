<?php

namespace App\Repository;

use App\Entity\Forul;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Forul>
 *
 * @method Forul|null find($id, $lockMode = null, $lockVersion = null)
 * @method Forul|null findOneBy(array $criteria, array $orderBy = null)
 * @method Forul[]    findAll()
 * @method Forul[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForulRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forul::class);
    }

//    /**
//     * @return Forul[] Returns an array of Forul objects
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

//    public function findOneBySomeField($value): ?Forul
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
