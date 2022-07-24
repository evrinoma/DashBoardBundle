<?php


namespace Evrinoma\DashBoardBundle\Provider;


interface ServiceInterface
{

    public function getName();

    public function getPort();

    public function getHost();

}