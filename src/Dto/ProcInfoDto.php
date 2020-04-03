<?php

namespace Evrinoma\DashBoardBundle\Dto;


use Evrinoma\DashBoardBundle\Dto\ProcInfo\ServiceDto;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProcInfoDto
 *
 * @package Evrinoma\DashBoardBundle\Dto
 */
class ProcInfoDto
{
//region SECTION: Fields
    /**
     * @var ServiceDto[]
     */
    private $service;
//endregion Fields

//region SECTION: Constructor
    /**
     * ProcInfoDto constructor.
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