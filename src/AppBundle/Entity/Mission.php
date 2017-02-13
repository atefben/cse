<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 15:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mission
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="MSN_MISSION")
 */
class Mission
{
    /**
     * @var
     * @ORM\Column(name="MSN_ID",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(name="MSN_DATE_DEBUT",type="datetime")
    */
    protected $dateDebut;

    /**
     * @var
     * @ORM\Column(name="MSN_DATE_FIN",type="datetime")
    */
    protected $dateFin;


    /**
     * @var
     * @ORM\JoinColumn(name="CLR_ID")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Collaborateur")
     */
    protected $collaborateur;



    /**
     * @var
     * @ORM\Column(name="MSN_COMMENTAIRE",type="text")
     */
    protected $commentaire;

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
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getCollaborateur()
    {
        return $this->collaborateur;
    }

    /**
     * @param mixed $collaborateur
     */
    public function setCollaborateur(Collaborateur $collaborateur)
    {
        $this->collaborateur = $collaborateur;
    }

    /**
     * @return mixed
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * @param mixed $commercial
     */
    public function setCommercial(UserApp $commercial)
    {
        $this->commercial = $commercial;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }


}