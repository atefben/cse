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
 * Class SurveyCollaborateur
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyCollaborateurRepository");
 * @ORM\Table(name="SRV_SURVEY_COLLABORATEUR")
 */
class SurveyCollaborateur
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
     * @ORM\Column(name="MSN_COMMENTAIRES_COLLABORATEUR", type="text")
     */
    protected $commentairesCollaborateur;


    /**
     * @var
     * @ORM\Column(name="MSN_SIGNATURE_COLLABORATEUR", type="text")
     */
    protected $signatureCollaborateur;


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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SurveyCollaborateurCriteria", mappedBy="surveyCollaborateur", cascade={"persist"})
     */
    protected $surveysCollaborateur;


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
     * @return \AppBundle\Entity\Collaborateur
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
     * @param \AppBundle\Entity\SurveyCollaborateurCriteria $survey
     *
     * @return Survey
     */
    public function addSurveyCollaborateur(\AppBundle\Entity\SurveyCollaborateurCriteria $surveyCollaborateur)
    {
        $this->surveysCollaborateur[] = $surveyCollaborateur;

        return $this;
    }

    /**
     * Remove survey
     *
     * @param \AppBundle\Entity\SurveyCriteria $survey
     */
    public function removeSurveyCollaborateur(\AppBundle\Entity\SurveyCollaborateurCriteria $surveyCollaborateur)
    {
        $this->surveysCollaborateur->removeElement($surveyCollaborateur);
    }

    /**
     * Get surveys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSurveysCollaborateur()
    {
        return $this->surveysCollaborateur;
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

    /**
     * Set commentairesCollaborateur
     *
     * @param string $commentairesCollaborateur
     *
     * @return SurveyCollaborateur
     */
    public function setCommentairesCollaborateur($commentairesCollaborateur)
    {
        $this->commentairesCollaborateur = $commentairesCollaborateur;

        return $this;
    }

    /**
     * Get commentairesCollaborateur
     *
     * @return string
     */
    public function getCommentairesCollaborateur()
    {
        return $this->commentairesCollaborateur;
    }

    /**
     * Set signatureCollaborateur
     *
     * @param string $signatureCollaborateur
     *
     * @return SurveyCollaborateur
     */
    public function setSignatureCollaborateur($signatureCollaborateur)
    {
        $this->signatureCollaborateur = $signatureCollaborateur;

        return $this;
    }

    /**
     * Get signatureCollaborateur
     *
     * @return string
     */
    public function getSignatureCollaborateur()
    {
        return $this->signatureCollaborateur;
    }

    /**
     * Add surveysCollaborateur
     *
     * @param \AppBundle\Entity\SurveyCollaborateurCriteria $surveysCollaborateur
     *
     * @return SurveyCollaborateur
     */
    public function addSurveysCollaborateur(\AppBundle\Entity\SurveyCollaborateurCriteria $surveysCollaborateur)
    {
        $this->surveysCollaborateur[] = $surveysCollaborateur;

        return $this;
    }

    /**
     * Remove surveysCollaborateur
     *
     * @param \AppBundle\Entity\SurveyCollaborateurCriteria $surveysCollaborateur
     */
    public function removeSurveysCollaborateur(\AppBundle\Entity\SurveyCollaborateurCriteria $surveysCollaborateur)
    {
        $this->surveysCollaborateur->removeElement($surveysCollaborateur);
    }
}
