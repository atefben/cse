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
     * @ORM\JoinColumn(nullable=true)
     **/
    protected $Customer;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Collaborateur
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set emailPro
     *
     * @param string $emailPro
     *
     * @return Collaborateur
     */
    public function setEmailPro($emailPro)
    {
        $this->email_pro = $emailPro;

        return $this;
    }

    /**
     * Get emailPro
     *
     * @return string
     */
    public function getEmailPro()
    {
        return $this->email_pro;
    }

    /**
     * Set emailPerso
     *
     * @param string $emailPerso
     *
     * @return Collaborateur
     */
    public function setEmailPerso($emailPerso)
    {
        $this->email_perso = $emailPerso;

        return $this;
    }

    /**
     * Get emailPerso
     *
     * @return string
     */
    public function getEmailPerso()
    {
        return $this->email_perso;
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
        $this->Customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string
     */
    public function getCustomer()
    {
        return $this->Customer;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Collaborateur
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set email
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
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
