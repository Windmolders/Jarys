<?php
/**
 * This file is part of the Clastic package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Clastic\ContactFormBundle\Module;

use Clastic\CoreBundle\Module\ModuleInterface;

/**
 * @author Jonas Windmolders
 */
class ContactFormModule implements ModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Contact Form';
    }

    /**
     * The icon of the module.
     *
     * @return string
     */
    public function getIcon()
    {
        return 'comments-o';
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
     * Gets the controller data for creating a tab system.
     *
     * @return array
     */
    public function getModuleControllers()
    {
        return array(
            '1' => array (
                'type' => 'contact_form_data',
                'title' => 'Data',
                'url' =>  'contact-form-data',
            ),
            '2' => array (
                'type' => 'contact_form_type',
                'title' => 'Categories',
                'url' =>  'contact-form-type',
            )
        );
    }

    /**
     * The default path of the module
     *
     * @return string
     */
    public function getDefaultPath()
    {
        return 'contact-form-data';
    }

    /**
     * The the unique identifier of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'contact_form';
    }
}
