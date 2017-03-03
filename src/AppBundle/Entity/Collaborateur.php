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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CollaborateurRepository");
 * @ORM\HasLifecycleCallbacks
 */
class Collaborateur
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CRT_CODE", type="string")
     **/
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="CRT_LASTNAME", type="string")
     **/
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(name="CRT_FIRSTNAME", type="string")
     **/
    protected $firstname;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", nullable=true)
     **/
    protected $customer;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     **/
    protected $user;

    /**
     * @var string
     * @ORM\Column(name="CRT_EMAIL", type="string")
     **/
    protected $email;


    /**
     * @var string
     * @ORM\Column(name="CRT_PHONE", type="string")
     **/
    protected $phone;

    /**
     * @var \DateTime
     * @ORM\Column(name="UPDATED_AT", type="datetime")
     **/
    protected  $updatedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="CREATED_AT", type="datetime")
     **/
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="LAST_EVAL_DATE", type="datetime")
     **/
    protected $lastEvalDate;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Collaborateur
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Collaborateur
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Collaborateur
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set manager
     *
     * @param string $manager
     *
     * @return Collaborateur
     */
    public function setUserManager($manager)
    {
        $this->user = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return string
     */
    public function getUserManager()
    {
        return $this->user;
    }

    /**
     * Set emailPro
     *
     * @param string $email
     *
     * @return Collaborateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get emailPro
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Collaborateur
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set customer
     *
     * @param string $customer
     *
     * @return Collaborateur
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
            $this->setLastEval(new \DateTime('now'));
        }
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Collaborateur
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
     * @return Collaborateur
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
     * @return Collaborateur
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
