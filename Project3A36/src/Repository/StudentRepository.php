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

    public function getStudentsByClassroom($id) : array {
        return $this->createQueryBuilder('s')
                ->join('s.idClassroom','c')
                ->addSelect('c')
                ->where('c.id=:id')
                ->setParameter('id',$id)
                ->getQuery()
                ->getResult();
    }

    public function getStudentsOrdredByEmail() :array {
        return $this->createQueryBuilder('s')
                ->orderBy('s.email','DESC')
                ->getQuery()
                ->getResult();
    }

    public function getStudentByNsc($nsc) : array {
        return $this->createQueryBuilder('s')
                ->where('s.nsc LIKE :nsc')
                ->setParameter('nsc',$nsc)
                ->getQuery()
                ->getResult();
    }

    public function searchByAVG($min,$max) :array {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM App\Entity\Student s WHERE s.average BETWEEN :min AND :max')
                    ->setParameter('min',$min)
                    ->setParameter('max',$max);

         return $query->getResult();           
    }

    public function getStudentOrderByEmail(){
        return $this->createQueryBuilder('s')
                ->orderBy('s.email','ASC')
                ->getQuery()
                ->getResult();
    }

    public function getStudentOrderByEmailDQL() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM App\Entity\Student s ORDER BY s.email ASC');
        return $query->getResult();
    }

    public function studentSearchByUserName($userName) {
        return $this->createQueryBuilder('s')
                ->where('s.userName LIKE :userName')
                ->setParameter('userName',$userName)
                ->getQuery()
                ->getResult();
    }

    public function studentSearchByUserNameDQL($userName){
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM App\Entity\Student s WHERE s.userName LIKE :username')
                    ->setParameter('username',$userName);
        return $query->getResult();
    }

    public function fetchStudentByClass($id) {
        return $this->createQueryBuilder('s')
                ->join('s.idClassroom','c')
                ->where('c.id = :id')
                ->setParameter('id',$id)
                ->getQuery()
                ->getResult();
    }

    public function fetchStudentByClassDQL($id){
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT s FROM App\Entity\Student s JOIN s.idClassroom c WHERE c.id = :id')
                ->setParameter('id',$id);
        return $query->getResult();
    }

    // public function getProductByCategory($idCategory) {
    //     return $this->createQueryBuilder('p')
    //             ->join('p.idCategory','c')
    //             ->where('c.id = :id')
    //             ->setParameter('id',$idCategory)
    //             ->getQuery()
    //             ->getResult();
    // }

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
