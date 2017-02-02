<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:42
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM;

class Survey
{
    protected $id;
    protected $dateSurvey;
    protected $mission;
    protected $commentairesClient;
    protected $signatureClient;
    protected $signatureResponsableAgence;
    protected $surveyCriterias;

    public function __construct()
    {
        $this->surveyCriterias = new ArrayCollection();
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
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @param mixed $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
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
     * @return mixed
     */
    public function getSignatureResponsableAgence()
    {
        return $this->signatureResponsableAgence;
    }

    /**
     * @param mixed $signatureResponsableAgence
     */
    public function setSignatureResponsableAgence($signatureResponsableAgence)
    {
        $this->signatureResponsableAgence = $signatureResponsableAgence;
    }

    /**
     * @return mixed
     */
    public function getSurveyCriterias()
    {
        return $this->surveyCriterias;
    }

    /**
     * @param mixed $surveyCriterias
     */
    public function setSurveyCriterias($surveyCriterias)
    {
        $this->surveyCriterias = $surveyCriterias;
    }


}