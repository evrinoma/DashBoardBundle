<?php

namespace Evrinoma\DashBoardBundle\Std;


use Evrinoma\DashBoardBundle\Std\ProcInfo\ServiceStd;
use Doctrine\Common\Collections\ArrayCollection;

class ProcInfoStd
{

    /**
     * @var ServiceStd[]
     */
    private $service;



    /**
     * ProcInfoStd constructor.
     */
    public function __construct()
    {
        $this->service = new ArrayCollection();
    }



    /**
     * @param $service
     *
     * @return $this
     */
    public function addService($service)
    {
        $this->service->add($service);

        return $this;
    }



    /**
     * @return ArrayCollection
     */
    public function getService(): ArrayCollection
    {
        return $this->service;
    }

}