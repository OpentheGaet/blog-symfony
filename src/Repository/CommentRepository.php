<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getCommentByAlbumId($id) {
        $db = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT c.content,
               c.date,
               u.name,
               u.first_name
        FROM comment AS c
        INNER JOIN album AS a
        ON c.album_id = a.id
        INNER JOIN user AS u
        ON c.user_id = u.id
        WHERE c.album_id = :albId
        ORDER BY c.date DESC
            ';
        $stmt = $db->prepare($sql);
        $stmt->execute(['albId' => $id]);
        return $stmt->fetchAll();
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
