<?php

namespace Evrinoma\DashBoardBundle\Controller;

use Evrinoma\DashBoardBundle\Event\InfoEvent;
use Evrinoma\DashBoardBundle\Manager\DashBoardManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DashBoardController
 *
 * @package Evrinoma\DashBoardBundle\Controller
 */
class DashBoardController extends AbstractController
{

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var DashBoardManager
     */
    private $dashBoardManager;



    public function __construct(EventDispatcherInterface $eventDispatcher, DashBoardManager $dashBoardManager)
    {
        $this->eventDispatcher  = $eventDispatcher;
        $this->dashBoardManager = $dashBoardManager;
    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function status()
    {
        $event = new InfoEvent($this->dashBoardManager->getDashBoard());
        $this->eventDispatcher->dispatch($event);

        return $this->render('@EvrinomaDashBoard/dashboard.html.twig', $event->getInfo());
    }


}