<?php

namespace AppBundle\Provider;


use AppBundle\Repository\CustomerRepository;
use Doctrine\ORM\EntityManager;

class CustomerProvider implements IProvider
{
    /**
     * @var CustomerRepository $customerRepository
     */
    private $customerRepository;

    /**
     * CollaboratorProvider constructor.
     * @param EntityManager $entityManager
     * @param string $repositoryID
     */
    public function __construct(EntityManager $entityManager, $repositoryID)
    {
        $this->customerRepository = $entityManager->getRepository($repositoryID);
    }

    /**
     * @param integer $userID
     * @return array
     */
    public function getCollaboratorsByUserID($userID)
    {
        return $this->customerRepository->findBy(['user'=>$userID]);
    }

    /**
     * @param $userID
     * @return array
     */
    public function getCustomerForBusiness($userID)
    {
        return $this->customerRepository->getCustomerForBusiness($userID);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->customerRepository->findAll();
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function findBy($criteria)
    {
        return $this->customerRepository->findBy($criteria);
    }
}