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

namespace Evrinoma\DashBoardBundle\Std\SysInfo;

class CpuStd
{
    private $model = '';
    private $cpuSpeed = '';
    private $cache = '';
    private $bogomips = 0;

    /**
     * @param mixed $cache
     *
     * @return CpuStd
     */
    public function addCache($cache): self
    {
        $this->cache += $cache;

        return $this;
    }

    /**
     * @param mixed $bogomips
     *
     * @return CpuStd
     */
    public function addBogomips($bogomips): self
    {
        $this->bogomips += $bogomips;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getCpuSpeed()
    {
        return $this->cpuSpeed;
    }

    /**
     * @return mixed
     */
    public function getCache()
    {
        return $this->cache.'B';
    }

    /**
     * @return mixed
     */
    public function getBogomips()
    {
        return $this->bogomips;
    }

    /**
     * @param mixed $model
     *
     * @return CpuStd
     */
    public function setModel($model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param mixed $cpuSpeed
     *
     * @return CpuStd
     */
    public function setCpuSpeed($cpuSpeed): self
    {
        $this->cpuSpeed = $cpuSpeed;

        return $this;
    }

    /**
     * @param mixed $cache
     *
     * @return CpuStd
     */
    public function setCache($cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param mixed $bogomips
     *
     * @return CpuStd
     */
    public function setBogomips($bogomips): self
    {
        $this->bogomips = $bogomips;

        return $this;
    }
}
