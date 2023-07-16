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

namespace Evrinoma\DashBoardBundle\Std;

use Doctrine\Common\Collections\ArrayCollection;

class ProcInfoStd
{
    private ArrayCollection $service;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function addService($service): self
    {
        $this->service->add($service);

        return $this;
    }

    public function getService(): ArrayCollection
    {
        return $this->service;
    }
}
