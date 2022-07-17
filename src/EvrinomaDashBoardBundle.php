<?php


namespace Evrinoma\DashBoardBundle;



use Evrinoma\DashBoardBundle\DependencyInjection\EvrinomaDashBoardExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaDashBoardBundle extends Bundle
{
    public const BUNDLE = 'dashboard';

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaDashBoardExtension();
        }
        return $this->extension;
    }
}