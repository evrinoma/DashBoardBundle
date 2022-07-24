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
    private $status;
    private $host;
    private $port;

    public function isAvailable()
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

    public function setStatusNA()
    {
        $this->status = self::STATUS_NA;

        return $this;
    }

    public function setStatusError()
    {
        $this->status = self::STATUS_ERROR;

        return $this;
    }

    public function setStatusOK()
    {
        $this->status = self::STATUS_OK;

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return ServiceStd
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $status
     *
     * @return ServiceStd
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param mixed $host
     *
     * @return ServiceStd
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @param mixed $port
     *
     * @return ServiceStd
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }
}
