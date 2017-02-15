<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:47
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
///(repositoryClass="AppBundle\Repository\SurveyCollaborateurCriteriaRepository");
/**
 * Class SurveyCriteria
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="SCR_SURVEY_COLLABORATEUR_CRITERIA")
 */
class SurveyCollaborateurCriteria
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(name="SCR_SCORE",type="integer",nullable=false)
     */
    protected $score;

    /**
     * @var
     * @ORM\Column(name="SCR_COEFFICIENT",type="integer",nullable=false)
     */
    protected $coefficient;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Criteria", inversedBy="criterias",cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    protected $criteria;

   /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SurveyCollaborateur", inversedBy="surveysCollaborateur",cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    protected $surveyCollaborateur;

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
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param mixed $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return mixed
     */
    public function getSurveyCollaborateur()
    {
        return $this->surveyCollaborateur;
    }

    /**
     * @param mixed $survey
     */
    public function setSurveyCollaborateur($surveyCollaborateur)
    {
        $this->surveyCollaborateur = $surveyCollaborateur;
    }





    /**
     * Set criteria
     *
     * @param \AppBundle\Entity\Criteria $criteria
     *
     * @return SurveyCriteria
     */
    public function setCriteria(\AppBundle\Entity\Criteria $criteria)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Get criteria
     *
     * @return \AppBundle\Entity\Criteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }
}
