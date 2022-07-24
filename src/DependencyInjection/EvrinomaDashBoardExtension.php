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

use Evrinoma\DashBoardBundle\EvrinomaDashBoardBundle;
use Evrinoma\DashBoardBundle\Menu\DashBoardMenu;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EvrinomaDashBoardExtension.
 */
class EvrinomaDashBoardExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('evrinoma.dash_board.dash_board_manager');
        $infos = $config['infos'];
        foreach ($infos as $info) {
            $definition->addMethodCall('addInfo', [new Reference($info)]);
        }
        $definition = $container->getDefinition('evrinoma.dash_board.info.proc_info');
        $provider = $config['provider'];
        if ($provider) {
            $definition->setArgument(0, new Reference($provider));
        }

        if ($config['registry']) {
            foreach ($config['registry'] as $key => $item) {
                switch (!$item) {
                    case str_contains(DashBoardMenu::class, $key)   :
                        $container->removeDefinition(DashBoardMenu::class);
                        break;
                    default:
                    }
            }
        }
    }

    public function getAlias()
    {
        return EvrinomaDashBoardBundle::BUNDLE;
    }
}
