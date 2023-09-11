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

use Evrinoma\DashBoardBundle\Voter\DashBoardRoleInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\MenuBundle\Dto\Preserve\MenuApiDto;
use Evrinoma\SecurityBundle\Voter\RoleInterface;

abstract class AbstractDashBoardMenu
{
    public function create(): DtoInterface
    {
        return (new MenuApiDto())
            ->setName('Status')
            ->setRoles([RoleInterface::ROLE_SUPER_ADMIN, DashBoardRoleInterface::ROLE_STATUS])
            ->setRoute('dashboard_status')
            ->setTag($this->tag());
    }
}
