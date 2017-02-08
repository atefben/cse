<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 17:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Collaborateur
 * @package AppBundle\Entity
 * @ORM\Table(name="CLR_COLLABORATEUR")
 * @ORM\Entity
 */
class Collaborateur
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="CLR_ID", type="integer")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CLR_EVERWIN_ID", type="string", length=20)
     * @Assert\NotBlank(message="L'identifiant everwin est obligatoire.")
    **/
    protected $everwinId;


    /**
     * @var string
     * @ORM\Column(name="CLR_FIRST_NAME", type="string", length=50)
     **/
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="CLR_LAST_NAME", type="string", length=50)
     **/
    protected $lastName;

//    /**
//     * @var string
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserApp")
//     * @ORM\JoinColumn(name="MANAGER_UAP_ID", referencedColumnName="UAP_ID")
//     **/
//    protected $userManager;

    /**
     * @var boolean
     * @ORM\Column(name="CLR_DELETED", type="boolean")
     **/
    protected $deleted;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function getEverwinId()
    {
        return $this->everwinId;
    }

    /**
     * @param string $everwinId
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

//    /**
//     * @return mixed
//     */
//    public function getUserManager()
//    {
//        return $this->userManager;
//    }
//
//    /**
//     * @param mixed $userManager
//     */
//    public function setUserManager($userManager)
//    {
//        $this->userManager = $userManager;
//    }

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