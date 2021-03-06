<?php

namespace Evrinoma\DashBoardBundle\Std\SysInfo;

class CpuStd
{
//region SECTION: Fields
    private $model    = '';
    private $cpuSpeed = '';
    private $cache    = '';
    private $bogomips = 0;
//endregion Fields

//region SECTION: Public
    /**
     * @param mixed $cache
     *
     * @return CpuStd
     */
    public function addCache($cache)
    {
        $this->cache += $cache;

        return $this;
    }

    /**
     * @param mixed $bogomips
     *
     * @return CpuStd
     */
    public function addBogomips($bogomips)
    {
        $this->bogomips += $bogomips;

        return $this;
    }
//endregion Public

//region SECTION: Getters/Setters
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
        return $this->cache . 'B';
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
    public function setModel($model):self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param mixed $cpuSpeed
     *
     * @return CpuStd
     */
    public function setCpuSpeed($cpuSpeed):self
    {
        $this->cpuSpeed = $cpuSpeed;

        return $this;
    }

    /**
     * @param mixed $cache
     *
     * @return CpuStd
     */
    public function setCache($cache):self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param mixed $bogomips
     *
     * @return CpuStd
     */
    public function setBogomips($bogomips):self
    {
        $this->bogomips = $bogomips;

        return $this;
    }
//endregion Getters/Setters

}