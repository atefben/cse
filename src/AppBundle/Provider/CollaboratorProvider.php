<?php

namespace AppBundle\Provider;


use AppBundle\Repository\CollaborateurRepository;
use Doctrine\ORM\EntityManager;

class CollaboratorProvider implements IProvider
{
    /**
     * @var CollaborateurRepository $collaboratorRepository
     */
    private $collaboratorRepository;

    /**
     * CollaboratorProvider constructor.
     * @param EntityManager $entityManager
     * @param string $repositoryID
     */
    public function __construct(EntityManager $entityManager, $repositoryID)
    {
        $this->collaboratorRepository = $entityManager->getRepository($repositoryID);
    }

    /**
     * @param integer $userID
     * @return array
     */
    public function getCollaboratorsByUserID($userID)
    {
        return $this->collaboratorRepository->findBy(['user'=>$userID]);
    }

    /**
     * @param $userID
     * @return array
     */
    public function getCollaboratorForBusiness($userID)
    {
        return $this->collaboratorRepository->getCollaboratorForBusiness($userID);
    }

    public function findAll()
    {
        return $this->collaboratorRepository->findAll();
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function findBy($criteria)
    {
        return $this->collaboratorRepository->findBy($criteria);
    }
}