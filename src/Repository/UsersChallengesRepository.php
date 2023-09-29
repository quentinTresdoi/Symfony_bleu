<?php

namespace App\Repository;

use App\Entity\UsersChallenges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UsersChallenges>
 *
 * @method UsersChallenges|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersChallenges|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersChallenges[]    findAll()
 * @method UsersChallenges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersChallengesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersChallenges::class);
    }

//    /**
//     * @return UsersChallenges[] Returns an array of UsersChallenges objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UsersChallenges
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
