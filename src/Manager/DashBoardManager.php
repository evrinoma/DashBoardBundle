<?php

namespace Evrinoma\DashBoardBundle\Manager;


use Evrinoma\DashBoardBundle\Info\InfoInterface;

/**
 * Class DashBoardManager
 *
 * @package Evrinoma\DashBoardBundle\Manager
 */
class DashBoardManager
{

//region SECTION: Fields
    /**
     * @var InfoInterface[]
     */
    private $infos = [];
//endregion Fields

//region SECTION: Constructor
    /**
     * DashBoard constructor.
     *
     * @param array $infos
     */
    public function __construct(array $infos)
    {
        foreach ($infos as $info) {
            $this->addInfo($info);
        }
    }
//endregion Constructor

//region SECTION: Public
    /**
     * DashBoard constructor.
     *
     * @param InfoInterface $info
     */
    public function addInfo(InfoInterface $info):void
    {
        $this->infos[$info->getAlias()] = $info;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return array
     */
    public function getDashBoard():array
    {
        $infos = [];

        foreach ($this->infos as $info) {
            $infos [$info->getAlias() ]= $info->createInfo()->getInfo();
        }

        return $infos;
    }
//endregion Getters/Setters
}