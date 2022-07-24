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


    /**
     * @var InfoInterface[]
     */
    private $infos = [];



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



    /**
     * DashBoard constructor.
     *
     * @param InfoInterface $info
     */
    public function addInfo(InfoInterface $info):void
    {
        $this->infos[$info->getAlias()] = $info;
    }



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

}