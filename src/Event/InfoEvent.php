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

namespace Evrinoma\DashBoardBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class InfoEvent extends Event
{
    protected array $info = [];

    public function __construct(array $info)
    {
        $this->info = $info;
    }

    public function addInfo(array $additional): void
    {
        $this->info += $additional;
    }

    public function getInfo(): array
    {
        return $this->info;
    }
}
