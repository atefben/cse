<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:47
 */

namespace AppBundle\Entity;


class SurveyCriteria
{
    protected $id;
    protected $score;
    protected $survey;
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