<?php

namespace AppBundle\Module;

use Clastic\NodeBundle\Module\NodeModuleInterface;

/**
 * SiteSetting
 */
class SiteSettingModule implements NodeModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Instellingen';
    }

    /**
     * The icon of the module.
     *
     * @return string
     */
    public function getIcon()
    {
        return 'gear';
    }

    /**
     * Check if it's a normal or node module
     *
     * @return string
     */
    public function isNormalModule()
    {
        return true;
    }

    /**
     * The name of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'site_setting';
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'AppBundle:SiteSetting';
    }

    /**
     * The default path of the module
     *
     * @return string
     */
    public function getDefaultPath()
    {
        return 'clastic_site_settings';
    }

    /**
     * @return string|bool
     */
    public function getDetailTemplate()
    {
        return 'AppBundle:SiteSetting:detail.html.twig';
    }
}
