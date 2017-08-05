<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    /**
     * @return Product[]
     */
    public function getPaginationQuery($em) {
        $dql = "SELECT product FROM AppBundle:Product product";
        $query = $em->createQuery($dql);
        return $query;
    }
}
