<?php

namespace AppBundle\Module;

use Clastic\NodeBundle\Module\NodeModuleInterface;

/**
 * Downloads
 */
class DownloadsModule implements NodeModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Downloads';
    }

    /**
     * The icon of the module.
     *
     * @return string
     */
    public function getIcon()
    {
        return 'download';
    }

    /**
     * The name of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'downloads';
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'AppBundle:Download';
    }

    /**
     * @return string|bool
     */
    public function getDetailTemplate()
    {
        return 'AppBundle:Downloads:detail.html.twig';
    }
}
