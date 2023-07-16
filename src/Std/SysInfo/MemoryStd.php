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

use Doctrine\Common\Collections\ArrayCollection;
use Evrinoma\DashBoardBundle\Core\SizeTrait;

class MemoryStd
{
    use SizeTrait;

    private int $memTotal = 0;
    private int $memFree = 0;
    private int $cached = 0;
    private int $swapTotal = 0;
    private int $swapFree = 0;
    private int $buffers = 0;
    private $devSwap;

    /**
     * MemoryStd constructor.
     */
    public function __construct()
    {
        $this->devSwap = new ArrayCollection();
    }

    /**
     * @param DiskStd $devSwap
     *
     * @return MemoryStd
     */
    public function addDevSwap(DiskStd $devSwap): self
    {
        $this->devSwap->add($devSwap);

        return $this;
    }

    public function calcRamApp()
    {
        return $this->getMemTotal() ? $this->getRamApp() / $this->getMemTotal() : 0;
    }

    public function calcRamSwap()
    {
        return ($this->getSwapTotal() !== $this->getSwapFree()) ? $this->getSwapFree() / $this->getSwapTotal() : 0;
    }

    public function calcRamBuffers()
    {
        return $this->getMemTotal() ? $this->getBuffers() / $this->getMemTotal() : 0;
    }

    public function calcRamCached()
    {
        return $this->getMemTotal() ? $this->getCached() / $this->getMemTotal() : 0;
    }

    /**
     * @return mixed
     */
    public function calcRam()
    {
        return ($this->getMemTotal() !== $this->getMemFree()) ? $this->getMemFree() / $this->getMemTotal() : 0;
    }

    /**
     * @return ArrayCollection
     */
    private function getDevSwap(): ArrayCollection
    {
        return $this->devSwap;
    }

    /**
     * @return mixed
     */
    private function getRamUsed()
    {
        return $this->getMemTotal() - $this->getMemFree();
    }

    /**
     * @return mixed
     */
    private function getBuffers()
    {
        return $this->buffers / $this->getSize();
    }

    /**
     * @return mixed
     */
    private function getMemFree()
    {
        return $this->memFree / $this->getSize();
    }

    /**
     * @return mixed
     */
    private function getCached()
    {
        return $this->cached / $this->getSize();
    }

    /**
     * @return mixed
     */
    private function getSwapFree()
    {
        return $this->swapFree / $this->getSize();
    }

    /**
     * @return mixed
     */
    public function getSwapUsed()
    {
        return $this->getSwapTotal() - $this->getSwapFree();
    }

    /**
     * @return mixed
     */
    public function getSwapTotal()
    {
        return $this->swapTotal / $this->getSize();
    }

    /**
     * @return mixed
     */
    public function getRamApp()
    {
        return $this->getRamUsed() - $this->getCached() - $this->getBuffers();
    }

    /**
     * @return mixed
     */
    public function getMemTotal()
    {
        return $this->memTotal / $this->getSize();
    }

    /**
     * @return mixed
     */
    public function getPercentRamApp()
    {
        return round($this->calcRamApp() * 100, 2);
    }

    /**
     * @return mixed
     */
    public function getPercentRamSwap()
    {
        return round($this->calcRamSwap() * 100, 2);
    }

    /**
     * @return mixed
     */
    public function getPercentRamBuffers()
    {
        return round($this->calcRamBuffers() * 100, 2);
    }

    /**
     * @return mixed
     */
    public function getPercentRamCached()
    {
        return round($this->calcRamCached() * 100, 2);
    }

    /**
     * @return mixed
     */
    public function getPercentRam()
    {
        return round($this->calcRam() * 100, 2);
    }

    public function setBuffers(int $buffers): self
    {
        $this->buffers = $buffers;

        return $this;
    }

    public function setMemTotal(int $memTotal): self
    {
        $this->memTotal = $memTotal;

        return $this;
    }

    public function setMemFree(int $memFree): self
    {
        $this->memFree = $memFree;

        return $this;
    }

    public function setCached(int $cached): self
    {
        $this->cached = $cached;

        return $this;
    }

    public function setSwapTotal(int $swapTotal): self
    {
        $this->swapTotal = $swapTotal;

        return $this;
    }

    public function setSwapFree(int $swapFree): self
    {
        $this->swapFree = $swapFree;

        return $this;
    }
}
