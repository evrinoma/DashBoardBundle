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

namespace Evrinoma\DashBoardBundle\Std\ProcInfo;

class ServiceStd
{
    private const STATUS_OK = 'OK';
    private const STATUS_ERROR = 'ERROR';
    private const STATUS_NA = 'NA';
    private $name;
    private string $status;
    private $host;
    private $port;

    public function isAvailable(): bool
    {
        return self::STATUS_OK === $this->status;
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
    public function getTag()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    public function setStatusNA(): self
    {
        $this->status = self::STATUS_NA;

        return $this;
    }

    public function setStatusError(): self
    {
        $this->status = self::STATUS_ERROR;

        return $this;
    }

    public function setStatusOK(): self
    {
        $this->status = self::STATUS_OK;

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return ServiceStd
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param mixed $host
     *
     * @return ServiceStd
     */
    public function setHost($host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param mixed $port
     *
     * @return ServiceStd
     */
    public function setPort($port): self
    {
        $this->port = $port;

        return $this;
    }
}
