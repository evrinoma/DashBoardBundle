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
use Evrinoma\DashBoardBundle\Std\ProcInfo\ServiceStd;

class ProcInfoStd
{
    /**
     * @var ServiceStd[]
     */
    private $service;

    /**
     * ProcInfoStd constructor.
     */
    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    /**
     * @param $service
     *
     * @return $this
     */
    public function addService($service)
    {
        $this->service->add($service);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getService(): ArrayCollection
    {
        return $this->service;
    }
}
