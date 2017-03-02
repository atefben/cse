<?php
namespace AppBundle\Repository;

/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 10/02/17
 * Time: 13:50
 */
class CustomerRepository extends \Doctrine\ORM\EntityRepository
{


    public function getCustomerForBusiness($idUser)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.user', 'User')
            ->where('User.userReponsable = :idUser')
            ->setParameter('idUser', $idUser)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getCustomerForBusinessForAlertEval($idUser)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.user', 'User')
            ->where('User.userReponsable = :idUser')
            ->andWhere("DATE_DIFF(DATE_ADD(c.lastEvalDate,:nbrDay,'day') , CURRENT_DATE()) BETWEEN 0 AND :nbrDayNotification")
            ->setParameter('idUser', $idUser)
            ->setParameter('nbrDay', 90)
            ->setParameter('nbrDayNotification', 7)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getCustomerForBusinessForAlertEvalByUser($idUser)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.user', 'User')
            ->where('User.id = :idUser')
            ->andWhere("DATE_DIFF(DATE_ADD(c.lastEvalDate,:nbrDay,'day') , CURRENT_DATE()) BETWEEN 0 AND :nbrDayNotification")
            ->setParameter('idUser', $idUser)
            ->setParameter('nbrDay', 90)
            ->setParameter('nbrDayNotification', 7)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllCustomerForAlertEval()
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->where("DATE_DIFF(DATE_ADD(c.lastEvalDate,:nbrDay,'day') , CURRENT_DATE()) BETWEEN 0 AND :nbrDayNotification")
            ->setParameter('nbrDay', 90)
            ->setParameter('nbrDayNotification', 7)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllCustomerForEvalExceeded()
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.user', 'User')
            ->where("DATE_DIFF(DATE_ADD(c.lastEvalDate,:nbrDay,'day') , CURRENT_DATE()) < 0")
            ->setParameter('nbrDay', 90)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    public function getAllCustomerForEvalExceededByUser($idUser)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->leftJoin('c.user', 'User')
            ->where('User.id = :idUser')
            ->orWhere('User.userReponsable = :idUser')
            ->andWhere("DATE_DIFF(DATE_ADD(c.lastEvalDate,:nbrDay,'day') , CURRENT_DATE()) < 0")
            ->setParameter('idUser', $idUser)
            ->setParameter('nbrDay', 90)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}