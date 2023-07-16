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

class LoadAvgStd
{
    private $loadAve1 = 0;
    private $loadAve5 = 0;
    private $loadAve15 = 0;

    private float $userCpuNext = 0;
    private float $niceCpuNext = 0;
    private float $systemCpuNext = 0;
    private float $idleCpuNext = 0;

    private float $userCpuLast = 0;
    private float $niceCpuLast = 0;
    private float $systemCpuLast = 0;
    private float $idleCpuLast = 0;

    /**
     * @return mixed
     */
    private function calcLoadCpu()
    {
        $loadLast = $this->getUserCpuLast() + $this->getNiceCpuLast() + $this->getSystemCpuLast();
        $totalLast = $loadLast + $this->getIdleCpuLast();

        $loadNext = $this->getUserCpuNext() + $this->getNiceCpuNext() + $this->getSystemCpuNext();
        $totalNext = $loadNext + $this->getIdleCpuNext();

        $loadCpu = ($totalNext !== $totalLast) ? ($loadNext - $loadLast) / ($totalNext - $totalLast) : 0;

        return $loadCpu;
    }

    private function getUserCpuLast(): float
    {
        return $this->userCpuLast;
    }

    private function getNiceCpuLast(): float
    {
        return $this->niceCpuLast;
    }

    private function getSystemCpuLast(): float
    {
        return $this->systemCpuLast;
    }

    private function getIdleCpuLast(): float
    {
        return $this->idleCpuLast;
    }

    private function getUserCpuNext(): float
    {
        return $this->userCpuNext;
    }

    private function getNiceCpuNext(): float
    {
        return $this->niceCpuNext;
    }

    private function getSystemCpuNext(): float
    {
        return $this->systemCpuNext;
    }

    private function getIdleCpuNext(): float
    {
        return $this->idleCpuNext;
    }

    /**
     * @return mixed
     */
    public function getLoadCpu()
    {
        return round($this->calcLoadCpu(), 2);
    }

    /**
     * @return mixed
     */
    public function getPercentCpu()
    {
//        $loadLast  = $this->getUserCpuLast() + $this->getNiceCpuLast() + $this->getSystemCpuLast();
//        $totalLast = $loadLast + $this->getIdleCpuLast();
//
//        $loadNext  = $this->getUserCpuNext() + $this->getNiceCpuNext() + $this->getSystemCpuNext();
//        $totalNext = $loadNext + $this->getIdleCpuNext();

        return round(100 * $this->calcLoadCpu(), 2);
    }

    /**
     * @return mixed
     */
    public function getLoadAve1()
    {
        return $this->loadAve1;
    }

    /**
     * @return mixed
     */
    public function getLoadAve5()
    {
        return $this->loadAve5;
    }

    /**
     * @return mixed
     */
    public function getLoadAve15()
    {
        return $this->loadAve15;
    }

    public function setUserCpuLast(float $userCpuLast): self
    {
        $this->userCpuLast = $userCpuLast;

        return $this;
    }

    public function setNiceCpuLast(float $niceCpuLast): self
    {
        $this->niceCpuLast = $niceCpuLast;

        return $this;
    }

    public function setSystemCpuLast(float $systemCpuLast): self
    {
        $this->systemCpuLast = $systemCpuLast;

        return $this;
    }

    public function setIdleCpuLast(float $idleCpuLast): self
    {
        $this->idleCpuLast = $idleCpuLast;

        return $this;
    }

    public function setUserCpuNext(float $userCpuNext): self
    {
        $this->userCpuNext = $userCpuNext;

        return $this;
    }

    public function setNiceCpuNext(float $niceCpuNext): self
    {
        $this->niceCpuNext = $niceCpuNext;

        return $this;
    }

    public function setSystemCpuNext(float $systemCpuNext): self
    {
        $this->systemCpuNext = $systemCpuNext;

        return $this;
    }

    public function setIdleCpuNext(float $idleCpuNext): self
    {
        $this->idleCpuNext = $idleCpuNext;

        return $this;
    }

    public function setLoadAve1($loadAve1): self
    {
        $this->loadAve1 = $loadAve1;

        return $this;
    }

    public function setLoadAve5($loadAve5): self
    {
        $this->loadAve5 = $loadAve5;

        return $this;
    }

    public function setLoadAve15($loadAve15): self
    {
        $this->loadAve15 = $loadAve15;

        return $this;
    }
}
