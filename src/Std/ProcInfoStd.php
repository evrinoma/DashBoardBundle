<?php

namespace Evrinoma\DashBoardBundle\Std;


use Evrinoma\DashBoardBundle\Std\ProcInfo\ServiceStd;
use Doctrine\Common\Collections\ArrayCollection;

class ProcInfoStd
{
//region SECTION: Fields
    /**
     * @var ServiceStd[]
     */
    private $service;
//endregion Fields

//region SECTION: Constructor
    /**
     * ProcInfoStd constructor.
     */
    public function __construct()
    {
        $this->service = new ArrayCollection();
    }
//endregion Constructor

//region SECTION: Public
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
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return ArrayCollection
     */
    public function getService(): ArrayCollection
    {
        return $this->service;
    }
//endregion Getters/Setters
}