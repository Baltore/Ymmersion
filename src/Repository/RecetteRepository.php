<?php

namespace App\Repository;

use App\Entity\Recette;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function add(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Recette $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLikedRecettesWithIngredients(User $user): array
    {
        return $this->createQueryBuilder('r')
            ->innerJoin('r.likes', 'l')
            ->andWhere(':user MEMBER OF r.likes')
            ->setParameter('user', $user)
            ->leftJoin('r.ingredients', 'i')
            ->addSelect('i')
            ->getQuery()
            ->getResult();
    }

    public function findMostLikedRecipes(): array
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.likes', 'l')
            ->groupBy('r.id')
            ->orderBy('COUNT(l)', 'DESC')
            ->setMaxResults(10) 
            ->getQuery()
            ->getResult();
    }
    public function findRecettesByFilters(?int $tempsPreparation, array $ingredients): array
    {
        $qb = $this->createQueryBuilder('r');

        if ($tempsPreparation) {
            $qb->andWhere('r.tempsPreparation <= :temps')
            ->setParameter('temps', $tempsPreparation);
        }

        if (!empty($ingredients)) {
            $qb->join('r.ingredients', 'ri')
            ->andWhere('ri.ingredient IN (:ingredients)')
            ->setParameter('ingredients', $ingredients);
        }

        return $qb->getQuery()->getResult();
    }

}
