<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\EventSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findLikeName(EventSearch $eventSearch, bool $isArchived): array
    {

        $queryBuilder = $this->createQueryBuilder('e');
        if ($eventSearch->getSearch()) {
            $queryBuilder->
            andWhere("e.title LIKE :name OR e.description LIKE :name OR e.summary LIKE :name OR e.article LIKE :name")
                ->andWhere('e.archive = :archive')
                ->setParameter('archive', $isArchived)
                ->setParameter('name', '%' . $eventSearch->getSearch() . '%')
                ->orderBy('e.title', 'ASC');

            return $queryBuilder->getQuery()->getResult();
        }
        return [];
    }
}


/*public function __construct(ManagerRegistry $registry)
{
    parent::__construct($registry, Event::class);
}

public function findLikeName(?string $name, int $archive): array
{
    $queryBuilder = $this->createQueryBuilder('e')
        ->andWhere("e.title LIKE :name OR e.description LIKE :name OR e.summary LIKE :name OR e.article LIKE :name")
        ->andWhere('e.archive = :archive')
        ->setParameter('archive', $archive)
        ->setParameter('name', '%' . $name . '%')
        ->orderBy('e.title', 'ASC')
        ->getQuery();
    return $queryBuilder->getResult();
}*/
