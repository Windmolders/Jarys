<?php

namespace AppBundle\Entity;

use Clastic\NodeBundle\Node\NodeReferenceInterface;
use Clastic\NodeBundle\Node\NodeReferenceTrait;

/**
 * Download
 */
class Download implements NodeReferenceInterface
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
    private $url;

    /**
     * @var string
     */
    private $content;


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
     * @return Download
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
     * Set url
     *
     * @param string $url
     *
     * @return Download
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Download
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

