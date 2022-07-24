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

namespace Evrinoma\DashBoardBundle;

use Evrinoma\DashBoardBundle\DependencyInjection\EvrinomaDashBoardExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaDashBoardBundle extends Bundle
{
    public const BUNDLE = 'dashboard';

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaDashBoardExtension();
        }

        return $this->extension;
    }
}
