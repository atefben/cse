<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:42
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Survey
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyRepository");
 * @ORM\Table(name="SRV_SURVEY")
 */
class Survey
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="SRV_DATE", type="datetime", nullable=true)
     */
    protected $dateSurvey;



    /**
     * @var
     * @ORM\Column(name="MSN_COMMENTAIRES_CLIENT", type="text")
     */
    protected $commentairesClient;


    /**
     * @var
     * @ORM\Column(name="MSN_SIGNATURE_CLIENT", type="text")
     */
    protected $signatureClient;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Collaborateur")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $collaborateur;

     /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SurveyCriteria", mappedBy="survey")
     */
    protected $surveys;


     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $customer;

    public function __construct()
    {
        $this->dateSurvey =  new \DateTime();//date('Y-m-d H:i:s');
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getDateSurvey()
    {
        return $this->dateSurvey;
    }

    /**
     * @param mixed $dateSurvey
     */
    public function setDateSurvey($dateSurvey)
    {
        $this->dateSurvey = $dateSurvey;
    }


    /**
     * @return mixed
     */
    public function getCommentairesClient()
    {
        return $this->commentairesClient;
    }

    /**
     * @param mixed $commentairesClient
     */
    public function setCommentairesClient($commentairesClient)
    {
        $this->commentairesClient = $commentairesClient;
    }

    /**
     * @return mixed
     */
    public function getSignatureClient()
    {
        return $this->signatureClient;
    }

    /**
     * @param mixed $signatureClient
     */
    public function setSignatureClient($signatureClient)
    {
        $this->signatureClient = $signatureClient;
    }




    /**
     * Set collaborateur
     *
     * @param \AppBundle\Entity\Collaborateur $collaborateur
     *
     * @return Survey
     */
    public function setCollaborateur(\AppBundle\Entity\Collaborateur $collaborateur)
    {
        $this->collaborateur = $collaborateur;

        return $this;
    }

    /**
     * Get collaborateur
     *
     * @return \ApprBundle\Entity\Collaborateur
     */
    public function getCollaborateur()
    {
        return $this->collaborateur;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Survey
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Add survey
     *
     * @param \AppBundle\Entity\SurveyCriteria $survey
     *
     * @return Survey
     */
    public function addSurvey(\AppBundle\Entity\SurveyCriteria $survey)
    {
        $this->surveys[] = $survey;

        return $this;
    }

    /**
     * Remove survey
     *
     * @param \AppBundle\Entity\SurveyCriteria $survey
     */
    public function removeSurvey(\AppBundle\Entity\SurveyCriteria $survey)
    {
        $this->surveys->removeElement($survey);
    }

    /**
     * Get surveys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurveys()
    {
        return $this->surveys;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Survey
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
