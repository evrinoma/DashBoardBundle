<?php


namespace Evrinoma\DashBoardBundle\Provider;


use Iterator;

interface ProviderInterface
{
//region SECTION: Getters/Setters
    /**
     * return Iterator|ServiceInterface[]
     */
    public function getService(): Iterator;
//endregion Getters/Setters
}
