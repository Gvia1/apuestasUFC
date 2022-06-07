<?php

namespace App\Repository;

use App\Entity\MovimientosFinancieros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovimientosFinancieros>
 *
 * @method MovimientosFinancieros|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovimientosFinancieros|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovimientosFinancieros[]    findAll()
 * @method MovimientosFinancieros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovimientosFinancierosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovimientosFinancieros::class);
    }

    public function add(MovimientosFinancieros $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MovimientosFinancieros $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MovimientosFinancieros[] Returns an array of MovimientosFinancieros objects
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

//    public function findOneBySomeField($value): ?MovimientosFinancieros
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
