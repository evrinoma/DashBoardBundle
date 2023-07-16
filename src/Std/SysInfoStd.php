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
    private string $vHostName = self::UNKNOWN;
    private string $cHostName = self::UNKNOWN;
    private string $ipAddress = self::UNKNOWN;
    private string $distrName = self::UNKNOWN;
    private string $distr = self::UNKNOWN;
    private string $kernel = self::UNKNOWN;
    private string $upTime = self::UNKNOWN;
    private string $users = self::UNKNOWN;
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

    public function __construct()
    {
        $this->scsi = new ArrayCollection();
        $this->usb = new ArrayCollection();
        $this->pci = new ArrayCollection();
        $this->disk = new ArrayCollection();
        $this->cpu = new ArrayCollection();
        $this->network = new ArrayCollection();
        $this->memory = new MemoryStd();
        $this->loadAvg = new LoadAvgStd();
    }

    public function addCpu(CpuStd $cpu): self
    {
        $this->cpu->add($cpu);

        return $this;
    }

    public function addDisk(DiskStd $disk): self
    {
        $this->disk->add($disk);

        return $this;
    }

    public function addNetwork(NetworkStd $network): self
    {
        $this->network->add($network);

        return $this;
    }

    public function addPci(DevStd $pci): self
    {
        $this->pci->add($pci);

        return $this;
    }

    public function addUsb(DevStd $usb): self
    {
        $this->usb->add($usb);

        return $this;
    }

    public function addScsi(ScsiStd $scsi): self
    {
        $this->scsi->add($scsi);

        return $this;
    }

    public function getCpu(): ArrayCollection
    {
        return $this->cpu;
    }

    public function getDisk(): ArrayCollection
    {
        return $this->disk;
    }

    public function getMemory(): MemoryStd
    {
        return $this->memory;
    }

    public function getNetwork(): ArrayCollection
    {
        return $this->network;
    }

    public function getPci(): ArrayCollection
    {
        return $this->pci;
    }

    public function getUsb(): ArrayCollection
    {
        return $this->usb;
    }

    public function getScsi(): ArrayCollection
    {
        return $this->scsi;
    }

    public function getLoadAvg(): LoadAvgStd
    {
        return $this->loadAvg;
    }

    public function getUsers(): string
    {
        return $this->users;
    }

    public function getUpTime(): string
    {
        return $this->upTime;
    }

    public function getKernel(): string
    {
        return $this->kernel;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getCHostName(): string
    {
        return $this->cHostName;
    }

    public function getVHostName(): string
    {
        return $this->vHostName;
    }

    public function getDistrName(): string
    {
        return $this->distrName;
    }

    public function getDistr(): string
    {
        return $this->distr;
    }

    public function setUsers(string $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function setUpTime(string $upTime): self
    {
        $this->upTime = $upTime;

        return $this;
    }

    public function setKernel(string $kernel): self
    {
        $this->kernel = $kernel;

        return $this;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function setCHostName(string $cHostName): self
    {
        $this->cHostName = $cHostName;

        return $this;
    }

    public function setVHostName($vHostName): self
    {
        $this->vHostName = $vHostName;

        return $this;
    }

    public function setDistrName(string $distrName): self
    {
        $this->distrName = $distrName;

        return $this;
    }

    public function setDistr(string $distr): self
    {
        $this->distr = $distr;

        return $this;
    }
}
