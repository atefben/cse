<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Customer;
use AppBundle\Enum\RoleType;
use AppBundle\Provider\Factory\ProviderFactory;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\User;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CustomerManager implements IManager
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
     * @var FormFactory $formFactory
     */
    private $formFactory;


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
     * @param FormFactory $formFactory
     */
    public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }


    public function getCustomers()
    {
        if ($this->user === null) {
            return null;
        }

        $customerProvider = $this->providerFactory->createCustomerProvider(
            $this->entityManager,
            'AppBundle:Customer'
        );

        $tabTwig = array();

        if ($this->user->getRoles()[0] == RoleType::AGENCY_MANAGER) {

            $myCustomers = $customerProvider->getCollaboratorsByUserID($this->user->getId());
            $tabTwig['MyCustomers'] =  $myCustomers;


            $listCustomerForBusiness = $customerProvider->getCustomerForBusiness($this->user->getId());
            $tabTwig['ListCustomerForBusiness'] =  $listCustomerForBusiness;

        } else if (
            $this->user->getRoles()[0] == RoleType::ADMIN ||
            $this->user->getRoles()[0] == RoleType::SUPER_ADMIN) {

            $myCustomers = $customerProvider->findAll();
            $tabTwig['MyCustomers'] =  $myCustomers;

        } else {
            $myCustomers = $customerProvider->findBy(['user' => $this->user->getId()]);
            $tabTwig['MyCustomers'] =  $myCustomers;


        }

        return $tabTwig;
    }

    public function getCustomerSurvey(Customer $customer)
    {
        $surveyProvider = $this->providerFactory->createSurveyProvider(
            $this->entityManager,
            'AppBundle:Survey'
        );

        return $surveyProvider->findBy(['customer' => $customer->getId()]);

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

    public function saveDatas()
    {
        $this->entityManager->flush();
    }
}
