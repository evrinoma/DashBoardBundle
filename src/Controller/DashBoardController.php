<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DashBoardBundle\Controller;

use Evrinoma\DashBoardBundle\Event\InfoEvent;
use Evrinoma\DashBoardBundle\Manager\DashBoardManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;

class DashBoardController extends AbstractController
{
    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @var DashBoardManager
     */
    private DashBoardManager $dashBoardManager;

    public function __construct(EventDispatcherInterface $eventDispatcher, DashBoardManager $dashBoardManager)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->dashBoardManager = $dashBoardManager;
    }

    public function status(): Response
    {
        $event = new InfoEvent($this->dashBoardManager->getDashBoard());
        $this->eventDispatcher->dispatch($event);

        return $this->render('@EvrinomaDashBoard/dashboard.html.twig', $event->getInfo());
    }
}
