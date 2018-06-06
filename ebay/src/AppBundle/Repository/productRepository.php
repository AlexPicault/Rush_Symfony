<?php

namespace AppBundle\Repository;

/**
 * productRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class productRepository extends \Doctrine\ORM\EntityRepository
{
    public function search($name)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM product 
        WHERE name LIKE :name
        ;';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name'=>$name."%"]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function searchCategory($category)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM product  
        WHERE  category_id LIKE :category_id
        ;';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['category_id'=>$category."%"]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function searchAll($name, $category_id, $maxPrice, $minPrice)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM product  
        WHERE  name LIKE :name AND category_id = :category AND maxPrice LIKE :maxPrice AND minPrice LIKE :minPrice
        ;';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name'=>$name."%", 'category_id'=>$category_id, 'maxPrice'=>$maxPrice, 'minPrice'=>$minPrice]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

}
