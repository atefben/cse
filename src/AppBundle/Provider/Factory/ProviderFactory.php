<?php

namespace AppBundle\Provider\Factory;


use AppBundle\Provider\CollaboratorProvider;
use AppBundle\Provider\CustomerProvider;
use AppBundle\Provider\MailListProvider;
use AppBundle\Provider\SurveyProvider;
use AppBundle\Provider\CriteriaProvider;
use Doctrine\ORM\EntityManager;

class ProviderFactory
{
    /**
     * @param EntityManager $entityManager
     * @param string $repositoryID
     *
     * @return CollaboratorProvider
     */
    public function createCollaboratorProvider(EntityManager $entityManager, $repositoryID) {

        return new CollaboratorProvider($entityManager, $repositoryID);
    }

    /**
 * @param EntityManager $entityManager
 * @param string $repositoryID
 *
 * @return CustomerProvider
 */
    public function createCustomerProvider(EntityManager $entityManager, $repositoryID) {

        return new CustomerProvider($entityManager, $repositoryID);
    }

    /**
     * @param EntityManager $entityManager
     * @param string $repositoryID
     *
     * @return SurveyProvider
     */
    public function createSurveyProvider(EntityManager $entityManager, $repositoryID) {

        return new SurveyProvider($entityManager, $repositoryID);
    }

    /**
     * @param EntityManager $entityManager
     * @param string $repositoryID
     *
     * @return CriteriaProvider
     */
    public function createCriteriaProvider(EntityManager $entityManager, $repositoryID) {

        return new CriteriaProvider($entityManager, $repositoryID);
    }

    /**
     * @param EntityManager $entityManager
     * @param string $repositoryID
     *
     * @return CriteriaProvider
     */
    public function createMailListProvider(EntityManager $entityManager, $repositoryID) {

        return new MailListProvider($entityManager, $repositoryID);
    }
}
