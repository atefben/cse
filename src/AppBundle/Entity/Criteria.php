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
     * @ORM\Id
     * @ORM\Column(name="CRT_ID", type="integer")
     **/
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="CRT_LABEL", type="string", length=20)
     **/
    protected $label;

    /**
     * @var string
     * @ORM\Column(name="CRT_COMMENTAIRES", type="text")
     **/
    protected $commentaires;

    /**
     * @var
     * @ORM\Column(name="CRT_COEFFICIENT", type="integer")
     */
    protected $coefficient;

    /**
     * @var boolean
     * @ORM\Column(name="CRT_REQUIRED", type="boolean")
     */
    protected $required;

    /**
     * @var boolean
     * @ORM\Column(name="CRT_TYPE", type="integer")
     */
    protected $criteriaType;

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
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaires
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    }

    /**
     * @return mixed
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param mixed $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param mixed $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }



}