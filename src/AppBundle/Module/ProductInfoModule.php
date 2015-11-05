<?php

namespace AppBundle\Module;

use Clastic\NodeBundle\Module\NodeModuleInterface;

/**
 * ProductInfo
 */
class ProductInfoModule implements NodeModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Product Info';
    }

    /**
     * The icon of the module.
     *
     * @return string
     */
    public function getIcon()
    {
        return 'info';
    }

    /**
     * The name of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'product_info';
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'AppBundle:ProductInfo';
    }

    /**
     * @return string|bool
     */
    public function getDetailTemplate()
    {
        return 'AppBundle:ProductInfo:detail.html.twig';
    }
}
