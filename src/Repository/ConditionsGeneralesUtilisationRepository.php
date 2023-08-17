<?php

namespace App\Repository;

use App\Entity\ConditionsGeneralesUtilisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConditionsGeneralesUtilisation>
 *
 * @method ConditionsGeneralesUtilisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConditionsGeneralesUtilisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConditionsGeneralesUtilisation[]    findAll()
 * @method ConditionsGeneralesUtilisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionsGeneralesUtilisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionsGeneralesUtilisation::class);
    }

//    /**
//     * @return ConditionsGeneralesUtilisation[] Returns an array of ConditionsGeneralesUtilisation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConditionsGeneralesUtilisation
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
