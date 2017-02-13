<?php

/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 13/02/17
 * Time: 14:51
 */
namespace AppBundle\Model;

class NoficationModel
{
    private $id;
    private $label;
    private $subject;
    private $bodyTemplate;
    private $conditions;
    private $roles;

    /**
     * NoficationModel constructor.
     * @param $id
     * @param $label
     * @param $subject
     * @param $bodyTemplate
     * @param $conditions
     * @param $roles
     */
    public function __construct($id, $label, $subject, $bodyTemplate, $conditions, $roles)
    {
        $this->id = $id;
        $this->label = $label;
        $this->subject = $subject;
        $this->bodyTemplate = $bodyTemplate;
        $this->conditions = $conditions;
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBodyTemplate()
    {
        return $this->bodyTemplate;
    }

    /**
     * @param mixed $bodyTemplate
     */
    public function setBodyTemplate($bodyTemplate)
    {
        $this->bodyTemplate = $bodyTemplate;
    }

    /**
     * @return mixed
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param mixed $conditions
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


}