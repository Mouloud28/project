<?php

namespace App\Repository;

use App\Entity\BandesAnnoncesTeasers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BandesAnnoncesTeasers>
 *
 * @method BandesAnnoncesTeasers|null find($id, $lockMode = null, $lockVersion = null)
 * @method BandesAnnoncesTeasers|null findOneBy(array $criteria, array $orderBy = null)
 * @method BandesAnnoncesTeasers[]    findAll()
 * @method BandesAnnoncesTeasers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandesAnnoncesTeasersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BandesAnnoncesTeasers::class);
    }

//    /**
//     * @return BandesAnnoncesTeasers[] Returns an array of BandesAnnoncesTeasers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BandesAnnoncesTeasers
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
