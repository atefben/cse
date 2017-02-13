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
use UserBundle\Entity\User;


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
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="MGP_LABEL", type="string", length=50)
     **/
    protected $label;

    /**
     * @var string
     * @ORM\Column(name="CRT_ACTIVE", type="boolean",options={"default" : true}))
     **/
    protected $active;


    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="mailGroups")
     */
    protected $users;

    public function __construct()
    {
        $this->active = true;
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

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users->add($user);
//        $user->addMailGroup($this);
        return $this;
    }

    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        $user->removeMailGroup($this);
    }


}