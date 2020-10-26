<?php


namespace Evrinoma\DashBoardBundle\Menu;

use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\DashBoardBundle\Voter\DashBoardRoleInterface;
use Evrinoma\MenuBundle\Entity\MenuItem;
use Evrinoma\MenuBundle\Menu\MenuInterface;

/**
 * Class DashBoardMenu
 *
 * @package Evrinoma\DashBoardBundle\Menu
 */
final class DashBoardMenu implements MenuInterface
{

    public function create(EntityManagerInterface $em): void
    {
        $display = new MenuItem();
        $display
            ->setRole([DashBoardRoleInterface::ROLE_STATUS])
            ->setName('Status')
            ->setRoute('dashboard_status')
            ->setTag($this->tag());

        $em->persist($display);
    }

    public function order(): int
    {
        return 0;
    }

    public function tag(): string
    {
        return MenuInterface::DEFAULT_TAG;
    }
}