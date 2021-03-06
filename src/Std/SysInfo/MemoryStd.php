<?php

namespace Evrinoma\DashBoardBundle\Std\SysInfo;

use Evrinoma\DashBoardBundle\Core\SizeTrait;
use Doctrine\Common\Collections\ArrayCollection;

class MemoryStd
{
    use SizeTrait;

//region SECTION: Fields
    private $memTotal  = 0;
    private $memFree   = 0;
    private $cached    = 0;
    private $swapTotal = 0;
    private $swapFree  = 0;
    private $buffers   = 0;
    private $devSwap;
//endregion Fields

//region SECTION: Constructor
    /**
     * MemoryStd constructor.
     */
    public function __construct()
    {
        $this->devSwap = new ArrayCollection();
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param DiskStd $devSwap
     *
     * @return MemoryStd
     */
    public function addDevSwap(DiskStd $devSwap):self
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

//endregion Public

//region SECTION: Private
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
//endregion Private

//region SECTION: Getters/Setters
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

    /**
     * @param mixed $buffers
     *
     * @return MemoryStd
     */
    public function setBuffers(int $buffers):self
    {
        $this->buffers = $buffers;

        return $this;
    }

    /**
     * @param mixed $memTotal
     *
     * @return MemoryStd
     */
    public function setMemTotal(int $memTotal):self
    {
        $this->memTotal = $memTotal;

        return $this;
    }

    /**
     * @param mixed $memFree
     *
     * @return MemoryStd
     */
    public function setMemFree(int $memFree):self
    {
        $this->memFree = $memFree;

        return $this;
    }

    /**
     * @param mixed $cached
     *
     * @return MemoryStd
     */
    public function setCached(int $cached):self
    {
        $this->cached = $cached;

        return $this;
    }

    /**
     * @param mixed $swapTotal
     *
     * @return MemoryStd
     */
    public function setSwapTotal(int $swapTotal):self
    {
        $this->swapTotal = $swapTotal;

        return $this;
    }

    /**
     * @param mixed $swapFree
     *
     * @return MemoryStd
     */
    public function setSwapFree(int $swapFree):self
    {
        $this->swapFree = $swapFree;

        return $this;
    }
//endregion Getters/Setters


}