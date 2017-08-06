<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    /**
     * @return Product[]
     */
    public function getPaginationQuery($user) {
        return $this->createQueryBuilder('product')
            ->andWhere('product.user = :user')
            ->setParameter('user', $user)
            ->orderBy('product.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}
