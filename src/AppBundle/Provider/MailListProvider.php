<?php

namespace AppBundle\Provider;


use AppBundle\Repository\MailListRepository;
use Doctrine\ORM\EntityManager;

class MailListProvider implements IProvider
{
    /**
     * @var CriteriaRepository $criteriaRepository
     */
    private $mailListRepository;

    /**
     * CriteriaProvider constructor.
     * @param EntityManager $entityManager
     * @param string $repositoryID
     */
    public function __construct(EntityManager $entityManager, $repositoryID)
    {
        $this->mailListRepository = $entityManager->getRepository($repositoryID);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->mailListRepository->findAll();
    }

    /**
     * @return MailList
     */
    public function find($id)
    {
        return $this->mailListRepository->find($id);
    }
}