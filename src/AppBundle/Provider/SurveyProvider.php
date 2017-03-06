<?php
/**
 * Created by PhpStorm.
 * User: thibaut
 * Date: 06/03/2017
 * Time: 12:22
 */

namespace AppBundle\Provider;

use AppBundle\Repository\SurveyRepository;
use Doctrine\ORM\EntityManager;

class SurveyProvider implements IProvider
{
    /**
     * @var SurveyRepository $customerRepository
     */
    private $surveyRepository;

    /**
     * CollaboratorProvider constructor.
     * @param EntityManager $entityManager
     * @param string $repositoryID
     */
    public function __construct(EntityManager $entityManager, $repositoryID)
    {
        $this->surveyRepository = $entityManager->getRepository($repositoryID);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->surveyRepository->findAll();
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function findBy($criteria)
    {
        return $this->surveyRepository->findBy($criteria);
    }
}