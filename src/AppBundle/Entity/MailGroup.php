<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 06/02/17
 * Time: 17:24
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class MailGroup
 * @package AppBundle\Entity
 * @ORM\Table(name="MGP_MAIL_GROUP")
 * @ORM\Entity
 */
class MailGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(name="MGP_ID", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="MGP_LABEL", type="string", length=50)
     **/
    protected $label;

    /**
     * @var string
     * @ORM\Column(name="CRT_ACTIVE", type="boolean")
     **/
    protected $active;



    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }


}