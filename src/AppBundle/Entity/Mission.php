<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 15:24
 */

namespace AppBundle\Entity;

use Doctrine\ORM;

class Mission
{
    protected $id;
    protected $dateDebut;
    protected $dateFin;
    protected $userCollab;
    protected $userCommercial;
    protected $commentaire;

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
    public function getUserCollab()
    {
        return $this->userCollab;
    }

    /**
     * @param mixed $userCollab
     */
    public function setUserCollab($userCollab)
    {
        $this->userCollab = $userCollab;
    }

    /**
     * @return mixed
     */
    public function getUserCommercial()
    {
        return $this->userCommercial;
    }

    /**
     * @param mixed $userCommercial
     */
    public function setUserCommercial($userCommercial)
    {
        $this->userCommercial = $userCommercial;
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