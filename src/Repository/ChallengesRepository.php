<?php

namespace App\Repository;

use App\Entity\Challenges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Challenges>
 *
 * @method Challenges|null find($id, $lockMode = null, $lockVersion = null)
 * @method Challenges|null findOneBy(array $criteria, array $orderBy = null)
 * @method Challenges[]    findAll()
 * @method Challenges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Challenges::class);
    }

//    /**
//     * @return Challenges[] Returns an array of Challenges objects
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

//    public function findOneBySomeField($value): ?Challenges
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
