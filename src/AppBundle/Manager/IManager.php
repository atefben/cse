<?php

namespace AppBundle\Manager;


use AppBundle\Provider\Factory\ProviderFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManager;

interface IManager
{

    /**
     * @param TokenStorage $tokenStorage
     */
    public function setUserFromSecurityContext(TokenStorage $tokenStorage);

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager);

    /**
     * @param ProviderFactory $providerFactory
     */
    public function setProviderFactory(ProviderFactory $providerFactory);
}