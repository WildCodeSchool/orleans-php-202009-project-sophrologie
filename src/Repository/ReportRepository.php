<?php

namespace App\Repository;

use App\Entity\Report;
use App\Entity\SearchAdminReports;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Report|null find($id, $lockMode = null, $lockVersion = null)
 * @method Report|null findOneBy(array $criteria, array $orderBy = null)
 * @method Report[]    findAll()
 * @method Report[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findWithFilterUsers(SearchAdminReports $search): ?array
    {
        if ($search->getUserSelected()) {
            $query = $this->createQueryBuilder('r')
                ->andWhere('r.patient = :patient')
                ->setParameter('patient', $search->getUserSelected())
                ->orderBy('r.id', 'DESC');
            return $query->getQuery()->getResult();
        }

        return $query = $this->findBy([], ['id' => 'DESC']);
    }

    // /**
    //  * @return Report[] Returns an array of Report objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Report
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
