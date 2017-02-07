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
 * @ORM\Entity
 * @ORM\Table(name="SRV_SURVEY")
 */
class Survey
{

    /**
     * @var \DateTime
     * @ORM\Id
     * @ORM\Column(name="SRV_ID")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="SRV_DATE", type="datetime", nullable=true)
     */
    protected $dateSurvey;

    /**
     * @var Mission $mission
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mission")
     * @ORM\JoinColumn(name="MSN_ID", referencedColumnName="MSN_ID")
     */
    protected $mission;

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
     * @var
     * @ORM\Column(name="MSN_SIGNATURE_RESP_AGENCE", type="text")
     */
    protected $signatureResponsableAgence;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SurveyCriteria", mappedBy="survey")
     */
    protected $surveyCriterias;

    public function __construct()
    {
        $this->surveyCriterias = new ArrayCollection();
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