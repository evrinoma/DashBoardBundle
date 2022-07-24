<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DashBoardBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('dashboard');
        $rootNode = $treeBuilder->getRootNode();

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
}
