<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FooEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FooEntity|null find(int $id)
 *
 * @extends ServiceEntityRepository<FooEntity>
 */
class FooEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FooEntity::class);
    }
}
