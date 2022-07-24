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

    private $userCpuNext = 0;
    private $niceCpuNext = 0;
    private $systemCpuNext = 0;
    private $idleCpuNext = 0;

    private $userCpuLast = 0;
    private $niceCpuLast = 0;
    private $systemCpuLast = 0;
    private $idleCpuLast = 0;

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

    /**
     * @return int
     */
    private function getUserCpuLast(): int
    {
        return $this->userCpuLast;
    }

    /**
     * @return int
     */
    private function getNiceCpuLast(): int
    {
        return $this->niceCpuLast;
    }

    /**
     * @return int
     */
    private function getSystemCpuLast(): int
    {
        return $this->systemCpuLast;
    }

    /**
     * @return int
     */
    private function getIdleCpuLast(): int
    {
        return $this->idleCpuLast;
    }

    /**
     * @return int
     */
    private function getUserCpuNext(): int
    {
        return $this->userCpuNext;
    }

    /**
     * @return int
     */
    private function getNiceCpuNext(): int
    {
        return $this->niceCpuNext;
    }

    /**
     * @return int
     */
    private function getSystemCpuNext(): int
    {
        return $this->systemCpuNext;
    }

    /**
     * @return int
     */
    private function getIdleCpuNext(): int
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

    /**
     * @param int $userCpuLast
     *
     * @return LoadAvgStd
     */
    public function setUserCpuLast(int $userCpuLast): self
    {
        $this->userCpuLast = $userCpuLast;

        return $this;
    }

    /**
     * @param int $niceCpuLast
     *
     * @return LoadAvgStd
     */
    public function setNiceCpuLast(int $niceCpuLast): self
    {
        $this->niceCpuLast = $niceCpuLast;

        return $this;
    }

    /**
     * @param int $systemCpuLast
     *
     * @return LoadAvgStd
     */
    public function setSystemCpuLast(int $systemCpuLast): self
    {
        $this->systemCpuLast = $systemCpuLast;

        return $this;
    }

    /**
     * @param int $idleCpuLast
     *
     * @return LoadAvgStd
     */
    public function setIdleCpuLast(int $idleCpuLast): self
    {
        $this->idleCpuLast = $idleCpuLast;

        return $this;
    }

    /**
     * @param int $userCpuNext
     *
     * @return LoadAvgStd
     */
    public function setUserCpuNext(int $userCpuNext): self
    {
        $this->userCpuNext = $userCpuNext;

        return $this;
    }

    /**
     * @param int $niceCpuNext
     *
     * @return LoadAvgStd
     */
    public function setNiceCpuNext(int $niceCpuNext): self
    {
        $this->niceCpuNext = $niceCpuNext;

        return $this;
    }

    /**
     * @param int $systemCpuNext
     *
     * @return LoadAvgStd
     */
    public function setSystemCpuNext(int $systemCpuNext): self
    {
        $this->systemCpuNext = $systemCpuNext;

        return $this;
    }

    /**
     * @param int $idleCpuNext
     *
     * @return LoadAvgStd
     */
    public function setIdleCpuNext(int $idleCpuNext): self
    {
        $this->idleCpuNext = $idleCpuNext;

        return $this;
    }

    /**
     * @param mixed $loadAve1
     *
     * @return LoadAvgStd
     */
    public function setLoadAve1($loadAve1): self
    {
        $this->loadAve1 = $loadAve1;

        return $this;
    }

    /**
     * @param mixed $loadAve5
     *
     * @return LoadAvgStd
     */
    public function setLoadAve5($loadAve5): self
    {
        $this->loadAve5 = $loadAve5;

        return $this;
    }

    /**
     * @param mixed $loadAve15
     *
     * @return LoadAvgStd
     */
    public function setLoadAve15($loadAve15): self
    {
        $this->loadAve15 = $loadAve15;

        return $this;
    }
}
