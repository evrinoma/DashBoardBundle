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

class NetworkStd
{
    private $name;
    private $rxBytes;
    private $rxPackets;
    private $rxErrors;
    private $rxDrop;
    private $txBytes;
    private $txPackets;
    private $txErrors;
    private $txDrop;

    /**
     * @return mixed
     */
    private function getRxPackets()
    {
        return $this->rxPackets;
    }

    /**
     * @return mixed
     */
    private function getRxErrors()
    {
        return $this->rxErrors;
    }

    /**
     * @return mixed
     */
    private function getRxDrop()
    {
        return $this->rxDrop;
    }

    /**
     * @return mixed
     */
    private function getTxPackets()
    {
        return $this->txPackets;
    }

    /**
     * @return mixed
     */
    private function getTxErrors()
    {
        return $this->txErrors;
    }

    /**
     * @return mixed
     */
    private function getTxDrop()
    {
        return $this->txDrop;
    }

    /**
     * @return mixed
     */
    private function getErrors()
    {
        return $this->getRxErrors() + $this->getTxErrors();
    }

    /**
     * @return mixed
     */
    private function getDrop()
    {
        return $this->getRxDrop() + $this->getTxDrop();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRxBytes()
    {
        return $this->rxBytes;
    }

    /**
     * @return mixed
     */
    public function getTxBytes()
    {
        return $this->txBytes;
    }

    /**
     * @param mixed $name
     *
     * @return NetworkStd
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $rxBytes
     *
     * @return NetworkStd
     */
    public function setRxBytes($rxBytes): self
    {
        $this->rxBytes = $rxBytes;

        return $this;
    }

    /**
     * @param mixed $rxPackets
     *
     * @return NetworkStd
     */
    public function setRxPackets($rxPackets): self
    {
        $this->rxPackets = $rxPackets;

        return $this;
    }

    /**
     * @param mixed $rxErrors
     *
     * @return NetworkStd
     */
    public function setRxErrors($rxErrors): self
    {
        $this->rxErrors = $rxErrors;

        return $this;
    }

    /**
     * @param mixed $rxDrop
     *
     * @return NetworkStd
     */
    public function setRxDrop($rxDrop): self
    {
        $this->rxDrop = $rxDrop;

        return $this;
    }

    /**
     * @param mixed $txBytes
     *
     * @return NetworkStd
     */
    public function setTxBytes($txBytes): self
    {
        $this->txBytes = $txBytes;

        return $this;
    }

    /**
     * @param mixed $txPackets
     *
     * @return NetworkStd
     */
    public function setTxPackets($txPackets): self
    {
        $this->txPackets = $txPackets;

        return $this;
    }

    /**
     * @param mixed $txErrors
     *
     * @return NetworkStd
     */
    public function setTxErrors($txErrors): self
    {
        $this->txErrors = $txErrors;

        return $this;
    }

    /**
     * @param mixed $txDrop
     *
     * @return NetworkStd
     */
    public function setTxDrop($txDrop): self
    {
        $this->txDrop = $txDrop;

        return $this;
    }
}
