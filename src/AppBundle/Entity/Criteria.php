<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 02/02/17
 * Time: 16:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Criteria
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="CRT_CRITERIA")
 */
class Criteria
{
    const COLLABORATEUR_CRITERIA = 1;
    const CLIENT_CRITERIA = 2;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CRT_LABEL", type="string", length=20)
     **/
    protected $label;

    /**
     * @var string
     * @ORM\Column(name="CRT_DESCRIPTION", type="text")
     **/
    protected $description;


    /**
     * @var boolean
     * @ORM\Column(name="CRT_TYPE", type="integer")
     */
    protected $criteriaType;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

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
     * Set description
     *
     * @param string $description
     *
     * @return Criteria
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set criteriaType
     *
     * @param integer $criteriaType
     *
     * @return Criteria
     */
    public function setCriteriaType($criteriaType)
    {
        $this->criteriaType = $criteriaType;

        return $this;
    }

    /**
     * Get criteriaType
     *
     * @return integer
     */
    public function getCriteriaType()
    {
        return $this->criteriaType;
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
}
