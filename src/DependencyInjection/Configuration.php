<?php


namespace Evrinoma\DashBoardBundle\DependencyInjection;

use Evrinoma\DashBoardBundle\Menu\DashBoardMenu;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Evrinoma\DashBoardBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('dashboard');
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->arrayNode('infos')->defaultValue([])->info('This option is used for custom Info data gathers')->scalarPrototype()
            ->end()->end()
            ->scalarNode('provider')->defaultNull()->info('This option is used for plugins service checking')->end()
            ->arrayNode('registry')->addDefaultsIfNotSet()->children()
            ->booleanNode('DashBoardMenu')->defaultTrue()->info('This option is used to enable status menu item')->end()
            ->end()->end()
        ;

        return $treeBuilder;
    }
//endregion Getters/Setters
}