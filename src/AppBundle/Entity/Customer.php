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
     * @param string $ciy
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
}
