<?php

namespace Jwi\ContactBundle\Module;

use Clastic\CoreBundle\Module\ModuleInterface;

/**
 * @author Jonas Windmolders <jonas_windmolders@hotmail.com>
 */
class ContactModule implements ModuleInterface
{
    /**
     * The name of the module.
     *
     * @return string
     */
    public function getName()
    {
        return 'Contact';
    }

    /**
     * The the unique identifier of the module.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return 'contact';
    }
}
