<?php

namespace UserBundle\Entity;


use AppBundle\Entity\MailGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

//use Gedmo\Mapping\Annotation as Gedmo;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="firstname", type="string")
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string")
     */
    private $lastname;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\MailGroup", inversedBy="users")
     * @ORM\JoinTable(name="UMG_USER_MAIL_GROUP",
     *       joinColumns={@ORM\JoinColumn(name="USR_ID", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="MGP_ID", referencedColumnName="MGP_ID")})
     */
    private $mailGroups;

    public function __construct() {
        parent::__construct();
        $this->mailGroups = new ArrayCollection();
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
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
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return User
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return mixed
     */
    public function getMailGroups()
    {
        return $this->mailGroups;
    }

    /**
     * @param mixed $mailGroups
     */
    public function setMailGroups($mailGroups)
    {
        $this->mailGroups = $mailGroups;
    }

    public function addMailGroup(MailGroup $mailGroup)
    {
        $this->mailGroups->add($mailGroup);
//        $mailGroup->addUser($this);
        return $this;
    }

    public function removeMailGroup(MailGroup $mailGroup)
    {
        $this->mailGroups->removeElement($mailGroup);
        $mailGroup->removeUser($this);
    }


}
