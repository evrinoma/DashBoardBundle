<?php


namespace Evrinoma\DashBoardBundle\Provider;


use Iterator;

interface ProviderInterface
{

    /**
     * return Iterator|ServiceInterface[]
     */
    public function getService(): Iterator;

}
