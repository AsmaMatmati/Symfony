<?php

namespace App\Repository;

use App\Entity\Medecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medecin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medecin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medecin[]    findAll()
 * @method Medecin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medecin::class);
    }

    // /**
    //  * @return Medecin[] Returns an array of Medecin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medecin
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findEntitiesByMedecin($nomm)
    {
            return $this->createQueryBuilder('i')
                ->where('i.nomMedecin LIKE :nomm')
                ->setParameter('nomm', '%'.$nomm.'%')
                ->getQuery()
                ->execute()
                ;
    }


    public function findEntitiesByPreMedecin($pre)
    {

        return $this->createQueryBuilder('i')
            ->where('i.prenomMed LIKE :pre')
            ->setParameter('pre', '%'.$pre.'%')
            ->getQuery()
            ->execute()
            ;
    }

    public function findEntitiesByTelMedecin($Tel)
    {
        return $this->createQueryBuilder('i')
            ->where('i.NumTel LIKE :Tel')
            ->setParameter('Tel', '%'.$Tel.'%')
            ->getQuery()
            ->execute()
            ;

    }
}
