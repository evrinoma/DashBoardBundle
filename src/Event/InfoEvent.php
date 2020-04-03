<?php

namespace Evrinoma\DashBoardBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class InfoEvent extends Event
{
//region SECTION: Fields
    /**
     * @var array
     */
    protected $info;
//endregion Fields

//region SECTION: Constructor
    /**
     * UserEvent constructor.
     */
    public function __construct(array $info)
    {
        $this->info = $info;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @param array $additional
     */
    public function addInfo(array $additional): void
    {
        $this->info += $additional;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }
//endregion Getters/Setters
}
