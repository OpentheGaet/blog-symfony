<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAdminUser() 
    {
        $db = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT u.id,
                   u.name,
                   u.first_name,
                   u.email
            FROM user u
            INNER JOIN role_user AS ru
            ON ru.user_id = u.id
            ORDER BY u.id ASC
            ';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getUser() 
    {
        $db = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT u.id,
               u.name,
               u.first_name,
               u.email
        FROM user u
        WHERE u.id NOT IN(
                   SELECT u.id 
                   FROM user u 
                   INNER JOIN role_user 
                   AS ru ON ru.user_id = u.id)
        ORDER BY u.id ASC
            ';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
