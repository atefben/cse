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
}