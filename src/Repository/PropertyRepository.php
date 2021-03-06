<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @param PropertySearch $propertySearch
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch $propertySearch): Query
    {
        $query = $this->findVisibleQuery();

        if ($propertySearch->getMinPrice()) {
            $query = $query->andWhere('p.price >= :minprice');
            $query->setParameter('minprice', $propertySearch->getMinPrice());
        }

        if ($propertySearch->getMaxPrice()) {
            $query = $query->andWhere('p.price <= :maxprice');
            $query->setParameter('maxprice', $propertySearch->getMaxPrice());
        }

        if ($propertySearch->getMinSurface()) {
            $query = $query->andWhere('p.surface >= :minsurface');
            $query->setParameter('minsurface', $propertySearch->getMinSurface());
        }

        if ($propertySearch->getMaxSurface()) {
            $query = $query->andWhere('p.surface <= :maxsurface');
            $query->setParameter('maxsurface', $propertySearch->getMaxSurface());
        }

        if ($propertySearch->getOptions()->count() > 0) {
            $k = 0;
            foreach ($propertySearch->getOptions() as $option) {
                $k++;
                $query = $query->andWhere(":options$k MEMBER OF p.options");
                $query->setParameter("options$k", $option);
            }
        }

            return $query->getQuery();
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
