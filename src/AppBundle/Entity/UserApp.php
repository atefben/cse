<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 15:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM;
use Symfony\Component\Security\Core\User\User;

/**
 * Class UserApp
 * @package AppBundle\Entity
 * @ORM\Table(name="UAP_USER_APP")
 */
class UserApp
{
    /**
     * @ORM\Id
     * @ORM\Column(name="UAP_ID")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="UAP_FIRST_NAME", type="varchar", length=50)
     **/
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="UAP_LAST_NAME", type="varchar", length=50)
     **/
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="UAP_DELETED", type="boolean", default=false)
     **/
    protected $deleted;

    /**
     * @var string
     * @ORM\Column(name="UAP_EMAIL", type="varchar", length=100)
     **/
    protected $email;

    /**
     * @var
     * @ORM\JoinColumn(name="UAP_ID",referencedColumnName="UAP_ID")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserApp")
     */
    protected $dependsOfUser;

    /**
     * @var
     * @ORM\JoinColumn(name="UAP_ID",referencedColumnName="UAP_ID")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserApp")
     */
    protected $roles;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDependsOfUser()
    {
        return $this->dependsOfUser;
    }

    /**
     * @param mixed $dependsOfUser
     */
    public function setDependsOfUser($dependsOfUser)
    {
        $this->dependsOfUser = $dependsOfUser;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }




}