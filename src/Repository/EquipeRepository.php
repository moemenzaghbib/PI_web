<?php

namespace App\Repository;

use App\Entity\Equipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipe[]    findAll()
 * @method Equipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipe::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Equipe $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Equipe $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }



    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateEquipe(int $id,int $value)
    {
        $entityManager = $this->getEntityManager();
        $equipe = $entityManager->getRepository(Equipe::class)->find($id);

        if (!$equipe) {
            throw $this->createNotFoundException(
                'No equipe found for id ' . $id
            );
        }

        $equipe->setNbreEmp($value);
        $entityManager->flush();
    }

    public function findTeamwithNumber($num){
        return $this->createQueryBuilder('equipe')
            ->where('equipe.numEquipe LIKE :numEquipe')
            ->setParameter('numEquipe', '%'.$num.'%')
            ->getQuery()
            ->getResult();
    }
    public function updateEq(int $id,int $value)
    {
        $em = $this->getEntityManager();
        $querry = $em->createQuery('UPDATE App\Entity\Equipe Set $nbreEmp =$value WHERE id = $id');
        $querry->execute();
    }

    public function DescEquipeSearch($order){
        $em = $this->getEntityManager();

            $query = $em->createQuery('SELECT e FROM App\Entity\Equipe e order by e.numEquipe DESC ');
        return $query->getResult();
        }

    public function AscEquipeSearch($order){
        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT e FROM App\Entity\Equipe e order by e.numEquipe ASC  ');
        return $query->getResult();
    }











    // /**
    //  * @return Equipe[] Returns an array of Equipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Equipe
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
