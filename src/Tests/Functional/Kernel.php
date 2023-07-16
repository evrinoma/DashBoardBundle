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

namespace Evrinoma\DashBoardBundle\Tests\Functional;

use Evrinoma\DashBoardBundle\EvrinomaDashBoardBundle;
use Evrinoma\SystemBundle\EvrinomaSystemBundle;
use Evrinoma\TestUtilsBundle\Kernel\AbstractApiKernel;
use Evrinoma\UtilsBundle\EvrinomaUtilsBundle;
use FOS\RestBundle\FOSRestBundle;
use Nelmio\ApiDocBundle\NelmioApiDocBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

/**
 * Kernel.
 */
class Kernel extends AbstractApiKernel
{
    protected string $bundlePrefix = 'DashBoardBundle';
    protected string $rootDir = __DIR__;
    protected array  $bundleConfig = ['fos_rest.yaml', 'framework.yaml'];

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new FOSRestBundle(),
            new NelmioApiDocBundle(),
            new EvrinomaUtilsBundle(),
            new EvrinomaDashBoardBundle(),
            new EvrinomaSystemBundle(),
        ];
    }

    protected function getBundleConfig(): array
    {
        return ['framework.yaml'];
    }
}
