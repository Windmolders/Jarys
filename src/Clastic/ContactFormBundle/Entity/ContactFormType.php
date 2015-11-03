<?php

namespace Clastic\ContactFormBundle\Entity;

/**
 * ContactFormType
 */
class ContactFormType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $contactFormDatas;

    /**
     * @return array
     */
    public function getContactFormDatas()
    {
        return $this->contactFormDatas;
    }

    /**
     * @param array $contactFormDatas
     */
    public function setContactFormDatas($contactFormDatas)
    {
        $this->contactFormDatas = $contactFormDatas;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return ContactFormType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ContactFormType
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
}

