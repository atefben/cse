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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository");
 * @ORM\Table(name="CST_CUSTOMER")
 */
class Customer
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CRT_CODE_SX", type="string", length=50)
     **/
    protected $codeSX;

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
     * @ORM\Column(name="CRT_ZIP_CODE", type="string", length=255)
     **/
    protected $zipCode;

        /**
     * @var string
     * @ORM\Column(name="CRT_CITY", type="string", length=255)
     **/
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     **/
    protected $user;

    /**
     * @var \DateTime
     * @ORM\Column(name="UPDATED_AT", type="date")
     **/
    protected  $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="CREATED_AT", type="date")
     **/
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="LAST_EVAL_DATE", type="date")
     **/
    protected $lastEvalDate;



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
     * Set codeSX
     *
     * @param string $codeSX
     *
     * @return Customer
     */
    public function setCodeSX($codeSX)
    {
        $this->codeSX = $codeSX;

        return $this;
    }

    /**
     * Get codeSX
     *
     * @return string
     */
    public function getCodeSX()
    {
        return $this->codeSX;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Customer
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set ciy
     *
     * @param string $city
     *
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get ciy
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Customer
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Customer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Customer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set lastEvalDate
     *
     * @param \DateTime $lastEvalDate
     *
     * @return Customer
     */
    public function setLastEvalDate($lastEvalDate)
    {
        $this->lastEvalDate = $lastEvalDate;

        return $this;
    }

    /**
     * Get lastEvalDate
     *
     * @return \DateTime
     */
    public function getLastEvalDate()
    {
        return $this->lastEvalDate;
    }
}
