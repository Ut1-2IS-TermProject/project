<?php

namespace App\Repository;

use App\Entity\Tissue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tissue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tissue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tissue[]    findAll()
 * @method Tissue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TissueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tissue::class);
    }

    public function findAllRecordsInsidePlane(int $x_low, int $y_low, int $x_high, int $y_high, int $z, $cell_class): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM Tissue t
                WHERE t.centroid_x BETWEEN :x_low AND :x_high AND
                      t.centroid_y BETWEEN :y_low AND :y_high AND
                      t.cell_class = :cell_class
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
                        'x_low' => $x_low,
                        'y_low' => $y_low,
                        'x_high' => $x_high,
                        'y_high' => $y_high,
                        'cell_class' => $cell_class
                        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return Tissue[] Returns an array of Tissue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tissue
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
