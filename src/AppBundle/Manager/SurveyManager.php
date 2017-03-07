<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Customer;
use AppBundle\Entity\Survey;
use AppBundle\Form\SurveyType;
use AppBundle\Provider\Factory\ProviderFactory;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\User;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SurveyManager implements IManager
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

    /**
     * @param Customer $customer
     * @return FormInterface
     */
    public function addNewSurvey(Customer $customer)
    {
        $userID = $this->user->getId();
        $survey = new Survey();

        $form = $this->formFactory->create(
            SurveyType::class,
            $survey,
            [
                'user'          => $userID,
                'customer'      => $customer->getId(),
                'criteriaType'  => 2
            ]
        );

        return $form;

    }

    public function saveDatas(FormInterface $form)
    {
        $this->entityManager->persist($form->getData());
        $this->entityManager->flush($form->getData());
    }
}
