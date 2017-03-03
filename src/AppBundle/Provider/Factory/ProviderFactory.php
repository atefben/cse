<?php

namespace AppBundle\Provider\Factory;


use AppBundle\Provider\CollaboratorProvider;
use Doctrine\ORM\EntityManager;

class ProviderFactory
{

    public function createCollaboratorProvider(EntityManager $entityManager) {

        return new CollaboratorProvider($entityManager);
    }
}