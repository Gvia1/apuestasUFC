<?php

namespace App\Repository;

use App\Entity\MetodoEspecifico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MetodoEspecifico>
 *
 * @method MetodoEspecifico|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetodoEspecifico|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetodoEspecifico[]    findAll()
 * @method MetodoEspecifico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetodoEspecificoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetodoEspecifico::class);
    }

    public function add(MetodoEspecifico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MetodoEspecifico $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MetodoEspecifico[] Returns an array of MetodoEspecifico objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MetodoEspecifico
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
