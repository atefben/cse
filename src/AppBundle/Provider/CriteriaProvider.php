<?php

namespace AppBundle\Provider;


use AppBundle\Repository\CriteriaRepository;
use Doctrine\ORM\EntityManager;

class CriteriaProvider implements IProvider
{
    /**
     * @var CriteriaRepository $criteriaRepository
     */
    private $criteriaRepository;

    /**
     * CriteriaProvider constructor.
     * @param EntityManager $entityManager
     * @param string $repositoryID
     */
    public function __construct(EntityManager $entityManager, $repositoryID)
    {
        $this->criteriaRepository = $entityManager->getRepository($repositoryID);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->criteriaRepository->findAll();
    }
}