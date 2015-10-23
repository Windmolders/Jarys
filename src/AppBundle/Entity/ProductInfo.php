<?php

namespace AppBundle\Entity;

use Clastic\NodeBundle\Node\NodeReferenceInterface;
use Clastic\NodeBundle\Node\NodeReferenceTrait;

/**
 * ProductInfo
 */
class ProductInfo implements NodeReferenceInterface
{
    use NodeReferenceTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $displayTitle;

    /**
     * @var string
     */
    private $content;

    /**
     * @var boolean
     */
    private $isActive = true;

    /**
     * @var Product
     */
    private $product;

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }


    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
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
     * Set displayTitle
     *
     * @param string $displayTitle
     *
     * @return ProductInfo
     */
    public function setDisplayTitle($displayTitle)
    {
        $this->displayTitle = $displayTitle;

        return $this;
    }

    /**
     * Get displayTitle
     *
     * @return string
     */
    public function getDisplayTitle()
    {
        return $this->displayTitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ProductInfo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

