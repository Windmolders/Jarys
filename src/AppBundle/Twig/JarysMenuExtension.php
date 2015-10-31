<?php
/**
 * This file is part of the Clastic package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

use Clastic\MenuBundle\Entity\MenuItem;
use Clastic\MenuBundle\Entity\MenuItemRepository;
use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;

/**
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class JarysMenuExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @var MenuItemRepository
     */
    private $repo;

    /**
     * @param MenuItemRepository $repository
     */
    public function __construct(MenuItemRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('jarys_clastic_menu', array($this, 'renderMenu'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param string $menuIdentifier
     * @param int    $depth
     *
     * @return string
     */
    public function renderMenu($menuIdentifier, $depth = 1, $type = 'main')
    {
        $queryBuilder = $this->repo->getNodesHierarchyQueryBuilder(null, false, array(), true)
            ->join('ClasticMenuBundle:Menu', 'menu', 'menu.id = node.menu')
            ->andWhere('menu.identifier = :identifier')
            ->setParameter('identifier', $menuIdentifier);

        $globals = $this->environment->getGlobals();

        /** @var GlobalVariables $variables */
        $variables = $globals['app'];
        $currentUrl = $variables->getRequest()->server->get('REQUEST_URI');

        $items = array_map(function(MenuItem $item) use ($currentUrl) {

            $url = $item->getUrl();
            $node = $item->getNode();
            // TODO Remove getTitle once a solution is found.
            if ($node && $node->getTitle() && isset($node->alias)) {
                $url = '/' . $node->alias->getAlias();
            }

            return array(
                'title' => $item->getTitle(),
                'left' => $item->getLeft(),
                'right' => $item->getRight(),
                'root' => $item->getRoot(),
                'level' => $item->getLevel(),
                'id' => $item->getId(),
                '_node' => $item,
                '_active' => ($url == $currentUrl),
                '_link' => $url,
            );
        }, $queryBuilder->getQuery()->getResult());

        $template = 'AppBundle:Twig:menu.html.twig';
        if( $type == 'footer') {
            $template = 'AppBundle:Twig:menu_footer.html.twig';
        }

        return $this->environment->render($template, array(
            'tree' => $this->repo->buildTree($items),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'jarys_clastic_menu';
    }
}
