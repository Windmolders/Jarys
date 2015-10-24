<?php

namespace AppBundle\Entity;

use Clastic\NodeBundle\Node\NodeReferenceInterface;
use Clastic\NodeBundle\Node\NodeReferenceTrait;

/**
 * Product
 */
class Product implements NodeReferenceInterface
{
    use NodeReferenceTrait;
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $shortDescription;

    /**
     * @var string
     */
    private $intro1;

    /**
     * @var string
     */
    private $intro2;

    /**
     * @var string
     */
    private $title1;

    /**
     * @var string
     */
    private $title2;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $displayTitle ;

    /**
     * @return string
     */
    public function getDisplayTitle()
    {
        return $this->displayTitle ;
    }

    /**
     * @param string $displayTitle
     */
    public function setDisplayTitle($displayTitle)
    {
        $this->displayTitle  = $displayTitle;
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
     * Set icon
     *
     * @param string $icon
     *
     * @return Product
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Product
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set intro1
     *
     * @param string $intro1
     *
     * @return Product
     */
    public function setIntro1($intro1)
    {
        $this->intro1 = $intro1;

        return $this;
    }

    /**
     * Get intro1
     *
     * @return string
     */
    public function getIntro1()
    {
        return $this->intro1;
    }

    /**
     * Set intro2
     *
     * @param string $intro2
     *
     * @return Product
     */
    public function setIntro2($intro2)
    {
        $this->intro2 = $intro2;

        return $this;
    }

    /**
     * Get intro2
     *
     * @return string
     */
    public function getIntro2()
    {
        return $this->intro2;
    }

    /**
     * Set title1
     *
     * @param string $title1
     *
     * @return Product
     */
    public function setTitle1($title1)
    {
        $this->title1 = $title1;

        return $this;
    }

    /**
     * Get title1
     *
     * @return string
     */
    public function getTitle1()
    {
        return $this->title1;
    }

    /**
     * Set title2
     *
     * @param string $title2
     *
     * @return Product
     */
    public function setTitle2($title2)
    {
        $this->title2 = $title2;

        return $this;
    }

    /**
     * Get title2
     *
     * @return string
     */
    public function getTitle2()
    {
        return $this->title2;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get $image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Product
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return strtolower($this->class);
    }

    /**
     * Get ProductInfo
     *
     * @return string
     */
    public function getProductInfo() {

        return 'tekst';
    }
}

