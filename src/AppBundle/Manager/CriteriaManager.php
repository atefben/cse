<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Criteria;
use AppBundle\Form\CriteriaType;
use AppBundle\Provider\Factory\ProviderFactory;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\User;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CriteriaManager implements IManager
{

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;

    /**
     * @var ProviderFactory $providerFactory
     */
    private $providerFactory;

    /**
     * @var FormFactory $formFactory
     */
    private $formFactory;

    /**
     * @param TokenStorage $tokenStorage
     */
    public function setUserFromSecurityContext(TokenStorage $tokenStorage)
    {
        $token = $tokenStorage->getToken();

        if ($token->getUser() === null) {
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
     * @param FormFactory $formFactory
     */
    public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getCriterias()
    {
        $this->entityManager->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());

        if ($this->user === null) {
            return null;
        }

        $criteriaProvider = $this->providerFactory->createCriteriaProvider(
            $this->entityManager,
            'AppBundle:Criteria'
        );

        $criterias = $criteriaProvider->findAll();

        return $criterias;
    }

    /**
     * @param string $formTypeClass
     * @param Object $datas
     * @param array $options
     *
     * @return FormInterface
     */
    public function createForm($formTypeClass, $datas = null, $options = array())
    {
        return $this->formFactory->create($formTypeClass, $datas, $options);
    }

    public function saveDatas(FormInterface $form)
    {
        $this->entityManager->persist($form->getData());
        $this->entityManager->flush($form->getData());
    }

    public function delete(Criteria $criterion)
    {
        $this->entityManager->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());
        $this->entityManager->remove($criterion);
        $this->entityManager->flush($criterion);
    }
}
