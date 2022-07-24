<?php


namespace Evrinoma\DashBoardBundle\Menu;

use Evrinoma\DashBoardBundle\Voter\DashBoardRoleInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\MenuBundle\Dto\Preserve\MenuApiDto;
use Evrinoma\MenuBundle\Registry\ObjectInterface;
use Evrinoma\SecurityBundle\Voter\RoleInterface;

final class DashBoardMenu implements ObjectInterface
{

//region SECTION: Public
    public function create(): DtoInterface
    {
        return (new MenuApiDto())
                    ->setName('Status')
            ->setRoles([RoleInterface::ROLE_SUPER_ADMIN, DashBoardRoleInterface::ROLE_STATUS])
            ->setRoute('dashboard_status')
            ->setTag($this->tag());
    }

    public function order(): int
    {
        return 0;
    }

    public function tag(): string
    {
        return ObjectInterface::DEFAULT_TAG;
    }
//endregion Public
}