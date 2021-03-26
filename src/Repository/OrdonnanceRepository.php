<?php

namespace App\Repository;

use App\Entity\Ordonnance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ordonnance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordonnance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordonnance[]    findAll()
 * @method Ordonnance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdonnanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordonnance::class);
    }

    // /**
    //  * @return Ordonnance[] Returns an array of Ordonnance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ordonnance
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /*  public function OrderByMedDQL()
      {
          $em=>$this->getEntityManager();
          $query = $em->createQuery('select s from App\Entity\Medicament s order by s.Name ASC ');
          return $query->getResult();

      }
  */


 /*   public function ListOrdonOrderByDate()
    {
        return $this->createQueryBuilder('i')
            ->join('i.Consultation','c')
            ->addSelect('c')
            ->where('c.dateC=:dateC')
            ->orderBy('c.dateC', 'ASC')
            ->getQuery()
            ->execute();

    }*/



    public function ListOrdoByDateDESC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.Consultation','DESC')
            ->getQuery()
            ->getResult();
    }

    public function ListOrdoByDateASC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.Consultation','ASC')
            ->getQuery()
            ->getResult();
    }


    public function recherche($dateC)
    {
        return $this->createQueryBuilder('s')
            ->where('s.Consultation LIKE :date')
            ->setParameter('date', '%'.$dateC.'%')
            ->getQuery()
            ->execute()
            ;
    }

}