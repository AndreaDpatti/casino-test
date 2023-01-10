<?php

namespace App\Repository;

use App\Entity\CasinoGameTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CasinoGameTable>
 *
 * @method CasinoGameTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CasinoGameTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CasinoGameTable[]    findAll()
 * @method CasinoGameTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasinoGameTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CasinoGameTable::class);
    }

    public function save(CasinoGameTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CasinoGameTable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findEntitiesByString($str) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\CasinoGameTable p
                WHERE p.name LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

//    /**
//     * @return CasinoGameTable[] Returns an array of CasinoGameTable objects
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

//    public function findOneBySomeField($value): ?CasinoGameTable
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
