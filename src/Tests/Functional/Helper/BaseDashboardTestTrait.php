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

namespace Evrinoma\DashBoardBundle\Tests\Functional\Helper;

use PHPUnit\Framework\Assert;

trait BaseDashboardTestTrait
{
    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey('system', $entity);
        Assert::assertArrayHasKey('procinfo', $entity['system']);
        Assert::assertArrayHasKey('sysinfo', $entity['system']);
    }
}
