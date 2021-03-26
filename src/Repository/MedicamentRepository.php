<?php

namespace App\Repository;

use App\Entity\Medicament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medicament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicament[]    findAll()
 * @method Medicament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicament::class);

    }

    public function findAllMed(){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT m
                FROM App\Entity\Medicament m"
            )
            ->getResult();
    }

    public function findEntitiesByString($medic){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m
                FROM App\Entity\Medicament m
                WHERE m.name LIKE :medic'
            )
            ->setParameter('medic', '%'.$medic.'%')
            ->getResult();
    }


    public function findEntitiesByNom($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m
                FROM App\Entity\Medicament m
                WHERE LOWER(m.name) LIKE LOWER(:str)'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function updateEntitiesByNom($str,$str1){
        return $this->getEntityManager()
            ->createQuery(
                'update App\Entity\Medicament m set m.stock=m.stock+:str1
                WHERE LOWER(m.name) LIKE LOWER(:str)'
            )
            ->setParameter('str', '%'.$str.'%')
            ->setParameter('str1', $str1)
            ->getResult();
    }
    public function countMed(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(m)
                FROM App\Entity\Medicament m'
            )
            ->getArrayResult();
    }
    // /**
    //  * @return Medicament[] Returns an array of Medicament objects
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
    public function findOneBySomeField($value): ?Medicament
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */




    public function ListMedicByNameASC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name','ASC')
            ->getQuery()
            ->getResult();
    }

    public function ListMedicByNameDESC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.name','DESC')
            ->getQuery()
            ->getResult();
    }

    public function ListMedicByPriceASC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.prix','ASC')
            ->getQuery()
            ->getResult();
    }

    public function ListMedicByPriceDESC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.prix','DESC')
            ->getQuery()
            ->getResult();
    }

    public function ListMedicByStockASC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.stock','ASC')
            ->getQuery()
            ->getResult();
    }

    public function ListMedicByStockDESC()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.stock','DESC')
            ->getQuery()
            ->getResult();
    }


    public function recherchePrix($prix)
    {
        return $this->createQueryBuilder('s')
            ->where('s.prix LIKE :prix')
            ->setParameter('prix', '%'.$prix.'%')
            ->getQuery()
            ->execute()
            ;
    }
    public function rechercheStock($stock)
    {
        return $this->createQueryBuilder('s')
            ->where('s.stock LIKE :stock')
            ->setParameter('stock', '%'.$stock.'%')
            ->getQuery()
            ->execute()
            ;
    }

    public function recherche($name)
    {
        return $this->createQueryBuilder('s')
            ->where('s.name LIKE :name')
            ->setParameter('name', '%'.$name.'%')
            ->getQuery()
            ->execute()
            ;
    }

}
