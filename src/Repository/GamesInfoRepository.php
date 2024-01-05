<?php

namespace App\Repository;

use App\Entity\GamesInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GamesInfo>
 *
 * @method GamesInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method GamesInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method GamesInfo[]    findAll()
 * @method GamesInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamesInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GamesInfo::class);
    }

//    /**
//     * @return GamesInfo[] Returns an array of GamesInfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GamesInfo
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
