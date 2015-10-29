<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 14/09/15
 * Time: 20:49
 */

namespace ESGISGabon\MainBundle\Menu;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Builder extends ContainerAware
{

    private function getSecurityContext()
    {
        return $this->container->get('security.context');
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function topSubMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('topSubMenu');

        //...

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function topMainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('topMainMenu');

        //...

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function footerSubMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('footerSubMenu');
        $menu->setChildrenAttribute('class', 'footer_tiny_menu');

        $menu->addChild('Groupe ESGIS', array('uri' => '#'));
        $menu->addChild('Presse', array('uri' => '#'));

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function footerMainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('footerMainMenu');
        $menu->setChildrenAttribute('class', 'footer_main_menu');

        $menu->addChild('Contacts', array('uri' => '#'));
        $menu->addChild('Mentions légales', array('uri' => '#'));
        $menu->addChild('Plan du site', array('uri' => '#'));
        $menu->addChild('Etudiants', array('uri' => '#'));
        $menu->addChild('Professionels', array('uri' => '#'));
        $menu->addChild('Infos pratiques', array('uri' => '#'));

        return $menu;
    }

    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function adminMainMenu(FactoryInterface $factory, array $options){
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'unstyled');

        $request = $this->container->get('request');

        $menu->addChild('Tableau de bord', array( 'route' => 'esgis_gabon_admin_homepage' ))
            ->setAttribute('materialicons', 'dashboard');

        if($this->getSecurityContext()->isGranted('ROLE_ADMIN')){
            $menu->addChild('Articles', array( 'uri' => "javascript:;" ))
                ->setLinkAttribute('data-action', 'sub')
                ->setAttributes(array( 'materialicons' => 'edit', 'submenu' => true ));

            $menu['Articles']->setChildrenAttribute('class', 'sub-menu unstyled');
            $menu['Articles']->addChild('Tous les articles', array('route' => 'esgis_gabon_admin_all_posts'));
            $menu['Articles']->addChild('Ajouter', array('route' => 'esgis_gabon_admin_add_post'));
            $menu['Articles']->addChild('Catégories', array('route' => 'esgis_gabon_admin_categories'));
            $menu['Articles']->addChild('Mots-clés', array('route' => 'esgis_gabon_admin_keywords'));

            switch($request->get('_route'))
            {
                case 'esgis_gabon_admin_edit_post':
                    $menu['Articles']['Tous les articles']->setCurrent(true);
                    break;
                case 'esgis_gabon_admin_edit_category':
                    $menu['Articles']['Catégories']->setCurrent(true);
                    break;
                case 'esgis_gabon_admin_edit_keyword':
                    $menu['Articles']['Mots-clés']->setCurrent(true);
                    break;
            }
        }


        return $menu;
    }
}