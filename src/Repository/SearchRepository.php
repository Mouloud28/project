<?php

namespace App\Repository;

use App\Entity\Search;
use App\Repository\FilmRepository;
use App\Repository\AlbumRepository;
use App\Repository\LivreRepository;
use App\Repository\SerieRepository;
use App\Repository\ArtisteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Search>
 *
 * @method Search|null find($id, $lockMode = null, $lockVersion = null)
 * @method Search|null findOneBy(array $criteria, array $orderBy = null)
 * @method Search[]    findAll()
 * @method Search[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchRepository extends ServiceEntityRepository
{
    private $artisteRepository;
    private $livreRepository;
    private $filmRepository;
    private $serieRepository;
    private $albumRepository;

    public function __construct(ManagerRegistry $registry, ArtisteRepository $artisteRepository,
    LivreRepository $livreRepository,
    FilmRepository $filmRepository,
    SerieRepository $serieRepository,
    AlbumRepository $albumRepository)
    {
        parent::__construct($registry, Search::class);
        $this->artisteRepository = $artisteRepository;
        $this->livreRepository = $livreRepository;
        $this->filmRepository = $filmRepository;
        $this->serieRepository = $serieRepository;
        $this->albumRepository = $albumRepository;
    }

//    /**
//     * @return Search[] Returns an array of Search objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Search
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
