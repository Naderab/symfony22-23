<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function add(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findStudentsOrdredByEmail() : array {
        return $this->createQueryBuilder('s')
                ->orderBy('s.email','ASC')
                ->getQuery()
                ->getResult();
    }

    public function searchByNsc($nsc) : array {
        return $this->createQueryBuilder('s')
                ->where('s.nsc LIKE :nsc')
                ->setParameter('nsc',$nsc)
                ->getQuery()
                ->getResult();
    }

    public function getStudentsByClassroom($id) : array {
        return $this->createQueryBuilder('s')
                ->join('s.classroom','c')
                ->where('c.id = :id')
                ->setParameter('id',$id)
                ->getQuery()
                ->getResult();
    }

    public function findStudentsNotAdmitted() :array {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM App\Entity\Student s WHERE s.average < 8');
        return $query->getResult();
    }

    public function findStudentsNotAdmittedQB() :array {
        return $this->createQueryBuilder('s')
                ->where('s.average < 8')
                ->getQuery()
                ->getResult();
    }



//    /**
//     * @return Student[] Returns an array of Student objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Student
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
