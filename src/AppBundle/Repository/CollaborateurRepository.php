<?php
namespace AppBundle\Repository;

/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 10/02/17
 * Time: 13:50
 */
class CollaborateurRepository extends \Doctrine\ORM\EntityRepository
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
            ->andWhere("DATE_ADD(c.last_eval_date,:nbrDay,'day') >= DATE_ADD(:today,:nbrDayNotification,'day')")
            ->setParameter('idUser', $idUser)
            ->setParameter('today', new \DateTime())
            ->setParameter('nbrDay', 90)
            ->setParameter('nbrDayNotification', 7)

        ;
        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}