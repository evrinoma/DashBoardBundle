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

namespace Evrinoma\DashBoardBundle\Menu;

use Evrinoma\MenuBundle\Registry\ObjectInterface;

final class DashBoardMenu extends AbstractDashBoardMenu implements ObjectInterface
{
    public function order(): int
    {
        return 0;
    }

    public function tag(): string
    {
        return ObjectInterface::DEFAULT_TAG;
    }
}
