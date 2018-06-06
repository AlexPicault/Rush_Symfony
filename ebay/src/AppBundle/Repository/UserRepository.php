<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function average($user_id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT AVG(rate_user) FROM rate
        WHERE user_id = :user_id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id'=>$user_id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetch();
    }
}
