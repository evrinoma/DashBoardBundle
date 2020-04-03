<?php


namespace Evrinoma\DashBoardBundle\Provider;


interface ScanServiceInterface extends ServiceInterface
{
    public function getProtocol():string;
}