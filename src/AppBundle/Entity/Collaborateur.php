<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 17:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Collaborateur
 * @package AppBundle\Entity
* @ORM\Table(name="collaborateur")
 */
class Collaborateur
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="ID", type="varchar", length=20)
     * @Assert\NotBlank(message="L'identifiant everwin est obligatoire.")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="EVERWIN_ID", type="varchar", length=20)
     * @Assert\NotBlank(message="L'identifiant everwin est obligatoire.")
    **/
    protected $everwinId;


    /**
     * @var string
     * @ORM\Column(name="FIRST_NAME", type="varchar", length=50)
     **/
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="LAST_NAME", type="varchar", length=50)
     **/
    protected $lastName;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserApp")
     * @ORM\JoinColumn(name="MGR_ID", referencedColumnName="ID")
     **/
    protected $userManager;

    /**
     * @var boolean
     * @ORM\Column(name="DELETED", type="boolean", default=false)
     **/
    protected $deleted;


    public function getEverwinId()
    {
        return $this->everwinId;
    }

    /**
     * @param mixed $everwinId
     */
    public function setEverwinId($everwinId)
    {
        $this->everwinId = $everwinId;
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
    public function getUserManager()
    {
        return $this->userManager;
    }

    /**
     * @param mixed $userManager
     */
    public function setUserManager($userManager)
    {
        $this->userManager = $userManager;
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
}