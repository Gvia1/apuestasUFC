<?php

namespace App\Repository;

use App\Entity\CombatePeleador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CombatePeleador>
 *
 * @method CombatePeleador|null find($id, $lockMode = null, $lockVersion = null)
 * @method CombatePeleador|null findOneBy(array $criteria, array $orderBy = null)
 * @method CombatePeleador[]    findAll()
 * @method CombatePeleador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CombatePeleadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CombatePeleador::class);
    }

    public function add(CombatePeleador $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CombatePeleador $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPeleadoresCombates($combatesId){
        $qb=$this->createQueryBuilder('cp');
        $qb->select('cp')
        ->where('cp.combate IN (:combates)')
        ->setParameter('combates', array_values($combatesId))
        ;
        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return CombatePeleador[] Returns an array of CombatePeleador objects
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

//    public function findOneBySomeField($value): ?CombatePeleador
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
