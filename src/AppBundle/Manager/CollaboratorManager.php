<?php

namespace AppBundle\Manager;

use AppBundle\Provider\Factory\CollaboratorProviderFactory;
use AppBundle\Provider\Factory\ProviderFactory;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class CollaboratorManager.
 */
class CollaboratorManager implements IManager
{

    /**
     * @var User
     */
    private $user;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ProviderFactory
     */
    private $providerFactory;

    /**
     * @param TokenStorage $tokenStorage
     */
    public function setUserFromSecurityContext(TokenStorage $tokenStorage)
    {
        $token = $tokenStorage->getToken();

        if (null === $token) {
            $this->user = null;
            return;
        }

        $this->user = $token->getUser();
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ProviderFactory $providerFactory
     */
    public function setProviderFactory(ProviderFactory $providerFactory)
    {
        $this->providerFactory = $providerFactory;
    }

    /**
     * 
     */
    public function getCollaborators()
    {
        if ($this->user === null) {
            return null;
        }

        $collaboratorTab = array();
        $collaboratorProvider = $this->providerFactory->createCollaboratorProvider($this->entityManager);

        if ($this->user->getRoles()[0] == "ROLE_RESPONSABLE_AGENCE") {

            $collaboratorTab['collaborateurs']               = $collaboratorProvider
                ->getCollaboratorsByUserID($this->user->getId());
            $collaboratorTab['ListCollaborateurForBusiness'] = $collaboratorProvider
                ->getCollaboratorForBusiness($this->user->getId());

        } else if ($this->user->getRoles()[0] == "ROLE_ADMIN" || $this->user->getRoles()[0] == "ROLE_SUPER_ADMIN") {

            $collaboratorTab['collaborateurs'] = $collaboratorProvider->findAll();

        } else {

            $collaboratorTab['collaborateurs'] = $collaboratorProvider->findBy(['user' => $this->user->getId()]);

        }
        
        return $collaboratorTab;
    }
}
