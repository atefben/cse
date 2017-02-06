<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:47
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Class SurveyCriteria
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="SCR_SURVEY_CRITERIA")
 */
class SurveyCriteria
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(name="SCR_ID")
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
     * @var
     * @ORM\JoinColumn(name="SRV_ID",referencedColumnName="SRV_ID")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Survey")
     */
    protected $survey;

    /**
     * @var
     * @ORM\Column(name="SCR_ADDITIONAL_NOTE",type="text")
     */
    protected $additionalNote;

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
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @param mixed $survey
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;
    }

    /**
     * @return mixed
     */
    public function getAdditionalNote()
    {
        return $this->additionalNote;
    }

    /**
     * @param mixed $additionalNote
     */
    public function setAdditionalNote($additionalNote)
    {
        $this->additionalNote = $additionalNote;
    }


}