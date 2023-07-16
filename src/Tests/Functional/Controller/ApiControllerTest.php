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

namespace Evrinoma\DashBoardBundle\Tests\Functional\Controller;

use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Evrinoma\TestUtilsBundle\Controller\ApiControllerTestTrait;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;
use Psr\Container\ContainerInterface;

/**
 * @group functional
 */
final class ApiControllerTest extends AbstractWebCaseTest
{
    use ApiControllerTestTrait;

    protected string $actionServiceName = 'evrinoma.dashboard.test.functional.action.dashboard';

    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }

    public static function getFixtures(): array
    {
        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;
        $actionService = $this->getActionService($container);
        $actionService->setClient($this->client);
        $actionService->setUrl();
        $this->setActionService($actionService);
    }

    protected function setActionService(ActionTestInterface $actionService): void
    {
        $this->actionService = $actionService;
    }

    protected function setUpEntityManager($container): void
    {
    }

    protected function setUpHandleStorage(): void
    {
    }

    protected function setUpSchemaTool(): void
    {
    }

    protected function setUpFixtures($container): void
    {
    }

    protected function purgeSchema(): void
    {
    }
}
