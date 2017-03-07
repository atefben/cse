<?php
namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CollaborateurRepository extends EntityRepository
{


    public function getCollaboratorForBusiness($idUser)
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

    public function getCollaboratorForBusinessForAlertEval($idUser)
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

    public function getCollaboratorForBusinessForAlertEvalByUser($idUser)
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

    public function getAllCollaboratorForAlertEval()
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

    public function getAllCollaboratorForEvalExceeded()
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

    public function getAllCollaboratorForEvalExceededByUser($idUser)
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

    public function getAllCollaboratorsByCustomerID($customerID)
    {
        $qb = $this
            ->createQueryBuilder('c')
            ->where('c.customer = :customerID')
            ->setParameter('customerID', $customerID)
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
