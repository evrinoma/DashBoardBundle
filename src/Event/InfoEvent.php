<?php

namespace Evrinoma\DashBoardBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class InfoEvent extends Event
{

    /**
     * @var array
     */
    protected $info;



    /**
     * UserEvent constructor.
     */
    public function __construct(array $info)
    {
        $this->info = $info;
    }



    /**
     * @param array $additional
     */
    public function addInfo(array $additional): void
    {
        $this->info += $additional;
    }



    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }

}
