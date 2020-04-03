<?php


namespace Evrinoma\DashBoardBundle\Provider;


interface ServiceInterface
{
//region SECTION: Getters/Setters
    public function getName();

    public function getPort();

    public function getHost();
//endregion Getters/Setters
}