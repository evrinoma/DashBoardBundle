<?php


namespace Evrinoma\DashBoardBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EvrinomaDashBoardExtension
 *
 * @package Evrinoma\DashBoardBundle\DependencyInjection
 */
class EvrinomaDashBoardExtension extends Extension
{
//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);
        $definition    = $container->getDefinition('evrinoma.dash_board.dash_board_manager');
        $infos         = $config['infos'];
        foreach ($infos as $info) {
            $definition->addMethodCall('addInfo', [new Reference($info)]);
        }
        $definition = $container->getDefinition('evrinoma.dash_board.info.proc_info');
        $provider     = $config['provider'];
        if ($provider) {
            $definition->setArgument(0, new Reference($provider));
        }
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getAlias()
    {
        return 'dashboard';
    }
//endregion Getters/Setters
}