<?php

namespace AppBundle\Provider\Factory;


use AppBundle\Provider\CollaboratorProvider;
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
}