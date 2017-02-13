<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 15:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Criteria
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="CST_CUSTOMER")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(name="CST_ID", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CRT_LABEL", type="string", length=50)
     **/
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="CRT_ADDRESS", type="string", length=255)
     **/
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="CRT_CONTACT", type="string", length=50)
     **/
    protected $contact;

    /**
     * @var \DateTime
     * @ORM\Column(name="CRT_DATE_INSERTION", type="datetime")
     **/
    protected $dtInsertion;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

//    protected $userInsertion;

    /**
     * @return mixed
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * @param mixed $rcs
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return mixed
     */
    public function getDtInsertion()
    {
        return $this->dtInsertion;
    }

    /**
     * @param mixed $dtInsertion
     */
    public function setDtInsertion(\DateTime $dtInsertion)
    {
        $this->dtInsertion = $dtInsertion;
    }

    /**
     * @return mixed
     */
    public function getUserInsertion()
    {
        return $this->userInsertion;
    }

    /**
     * @param mixed $userInsertion
     */
    public function setUserInsertion($userInsertion)
    {
        $this->userInsertion = $userInsertion;
    }



}