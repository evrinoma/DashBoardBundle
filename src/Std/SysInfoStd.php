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
use Evrinoma\DashBoardBundle\Std\SysInfo\CpuStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\DevStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\DiskStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\LoadAvgStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\MemoryStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\NetworkStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\ScsiStd;

class SysInfoStd
{
    public const UNKNOWN = 'unknown';
    private $vHostName = self::UNKNOWN;
    private $cHostName = self::UNKNOWN;
    private $ipAddress = self::UNKNOWN;
    private $distrName = self::UNKNOWN;
    private $distr = self::UNKNOWN;
    private $kernel = self::UNKNOWN;
    private $upTime = self::UNKNOWN;
    private $users = self::UNKNOWN;
    private $loadAvg;
    /**
     * @var ScsiStd[]
     */
    private $scsi;
    /**
     * @var DevStd[]
     */
    private $usb;
    /**
     * @var DevStd[]
     */
    private $pci;
    /**
     * @var NetworkStd[]
     */
    private $network;
    /**
     * @var DiskStd[]
     */
    private $disk;
    private $memory;
    /**
     * @var CpuStd[]
     */
    private $cpu;

    /**
     * SysInfoStd constructor.
     */
    public function __construct()
    {
        $this->loadAvg = new LoadAvgStd();
        $this->scsi = new ArrayCollection();
        $this->usb = new ArrayCollection();
        $this->pci = new ArrayCollection();
        $this->network = new ArrayCollection();
        $this->memory = new MemoryStd();
        $this->disk = new ArrayCollection();
        $this->cpu = new ArrayCollection();
    }

    /**
     * @param CpuStd $cpu
     *
     * @return $this
     */
    public function addCpu(CpuStd $cpu)
    {
        $this->cpu->add($cpu);

        return $this;
    }

    /**
     * @param DiskStd $disk
     *
     * @return $this
     */
    public function addDisk(DiskStd $disk)
    {
        $this->disk->add($disk);

        return $this;
    }

    /**
     * @param NetworkStd $network
     *
     * @return $this
     */
    public function addNetwork(NetworkStd $network)
    {
        $this->network->add($network);

        return $this;
    }

    /**
     * @param DevStd $pci
     *
     * @return $this
     */
    public function addPci(DevStd $pci)
    {
        $this->pci->add($pci);

        return $this;
    }

    /**
     * @param DevStd $usb
     *
     * @return $this
     */
    public function addUsb(DevStd $usb)
    {
        $this->usb->add($usb);

        return $this;
    }

    /**
     * @param ScsiStd $scsi
     *
     * @return SysInfoStd
     */
    public function addScsi(ScsiStd $scsi)
    {
        $this->scsi->add($scsi);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCpu(): ArrayCollection
    {
        return $this->cpu;
    }

    /**
     * @return ArrayCollection
     */
    public function getDisk(): ArrayCollection
    {
        return $this->disk;
    }

    /**
     * @return MemoryStd
     */
    public function getMemory(): MemoryStd
    {
        return $this->memory;
    }

    /**
     * @return ArrayCollection
     */
    public function getNetwork(): ArrayCollection
    {
        return $this->network;
    }

    /**
     * @return ArrayCollection
     */
    public function getPci(): ArrayCollection
    {
        return $this->pci;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsb(): ArrayCollection
    {
        return $this->usb;
    }

    /**
     * @return ArrayCollection
     */
    public function getScsi(): ArrayCollection
    {
        return $this->scsi;
    }

    /**
     * @return LoadAvgStd
     */
    public function getLoadAvg(): LoadAvgStd
    {
        return $this->loadAvg;
    }

    /**
     * @return string
     */
    public function getUsers(): string
    {
        return $this->users;
    }

    /**
     * @return string
     */
    public function getUpTime(): string
    {
        return $this->upTime;
    }

    /**
     * @return string
     */
    public function getKernel(): string
    {
        return $this->kernel;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getCHostName(): string
    {
        return $this->cHostName;
    }

    /**
     * @return mixed
     */
    public function getVHostName()
    {
        return $this->vHostName;
    }

    /**
     * @return string
     */
    public function getDistrName(): string
    {
        return $this->distrName;
    }

    /**
     * @return string
     */
    public function getDistr(): string
    {
        return $this->distr;
    }

    /**
     * @param string $users
     *
     * @return SysInfoStd
     */
    public function setUsers(string $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @param string $upTime
     *
     * @return SysInfoStd
     */
    public function setUpTime(string $upTime)
    {
        $this->upTime = $upTime;

        return $this;
    }

    /**
     * @param string $kernel
     *
     * @return SysInfoStd
     */
    public function setKernel(string $kernel)
    {
        $this->kernel = $kernel;

        return $this;
    }

    /**
     * @param string $ipAddress
     *
     * @return SysInfoStd
     */
    public function setIpAddress(string $ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * @param string $cHostName
     *
     * @return SysInfoStd
     */
    public function setCHostName(string $cHostName)
    {
        $this->cHostName = $cHostName;

        return $this;
    }

    /**
     * @param mixed $vHostName
     *
     * @return SysInfoStd
     */
    public function setVHostName($vHostName)
    {
        $this->vHostName = $vHostName;

        return $this;
    }

    /**
     * @param string $distrName
     *
     * @return SysInfoStd
     */
    public function setDistrName(string $distrName)
    {
        $this->distrName = $distrName;

        return $this;
    }

    /**
     * @param string $distr
     *
     * @return SysInfoStd
     */
    public function setDistr(string $distr)
    {
        $this->distr = $distr;

        return $this;
    }
}
