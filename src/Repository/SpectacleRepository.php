<?php

namespace App\Repository;

use App\Entity\Spectacle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Spectacle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spectacle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spectacle[]    findAll()
 * @method Spectacle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpectacleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spectacle::class);
    }

    public function findLikeName(string $search)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.town LIKE :town')
            ->setParameter('town', '%' . $search . '%')
            ->orderBy('s.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
