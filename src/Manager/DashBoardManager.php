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

namespace Evrinoma\DashBoardBundle\Manager;

use Evrinoma\DashBoardBundle\Info\InfoInterface;

/**
 * Class DashBoardManager.
 */
class DashBoardManager
{
    /**
     * @var InfoInterface[]
     */
    private array $infos = [];

    /**
     * DashBoard constructor.
     *
     * @param array $infos
     */
    public function __construct(array $infos)
    {
        foreach ($infos as $info) {
            $this->addInfo($info);
        }
    }

    /**
     * DashBoard constructor.
     *
     * @param InfoInterface $info
     */
    public function addInfo(InfoInterface $info): void
    {
        $this->infos[$info->getAlias()] = $info;
    }

    /**
     * @return array
     */
    public function getDashBoard(): array
    {
        $infos = [];

        foreach ($this->infos as $info) {
            $infos[$info->getAlias()] = $info->createInfo()->getInfo();
        }

        return $infos;
    }
}
