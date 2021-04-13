<?php

namespace App\Repository;

use App\Entity\Chambre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chambre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chambre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chambre[]    findAll()
 * @method Chambre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChambreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chambre::class);
    }
    /**
     * Requete QueryBuilder
     */
    public function listChambreorderbyNum(){
        return $this->createQueryBuilder('c')->orderBy('c.num','DESC')->getQuery()
            ->getResult();
    }
    public function listChambreorderbyNbrplace(){
        return $this->createQueryBuilder('c')->orderBy('c.num','ASC')->getQuery()
            ->getResult();
    }
    public function listChambreorderbyEtage(){
        return $this->createQueryBuilder('c')->orderBy('c.num','DESC')->getQuery()
            ->getResult();
    }
    public function recherche($num){
        return $this->createQueryBuilder('c')->where('c.num LIKE :num')->setParameter('num',"%".$num."%")
            ->getQuery() ->execute();}



    public function findChambrebyCategorie(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c.nom as nomCategorie, COUNT(*) as sumChambre 
            from chambre ch, category c 
            WHERE ch.category_id = c.id 
            group by category_id'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    public function countid($value): ?int
    {
        return $this->createQueryBuilder('t')
            ->select('count(t.num)')
            ->andWhere('t.category = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getSingleScalarResult();
    }








    // /**
    //  * @return Chambre[] Returns an array of Chambre objects
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
    public function findOneBySomeField($value): ?Chambre
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
