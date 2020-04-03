<?php


namespace Evrinoma\DashBoardBundle\Info;


interface InfoInterface
{
    public function createInfo():InfoInterface;
    public function getInfo();
    public function getAlias():string;
}