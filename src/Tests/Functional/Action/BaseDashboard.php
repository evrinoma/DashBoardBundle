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

namespace Evrinoma\DashBoardBundle\Tests\Functional\Action;

use Evrinoma\DashBoardBundle\Tests\Functional\Helper\BaseDashboardTestTrait;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

class BaseDashboard extends AbstractServiceTest implements BaseDashboardTestInterface
{
    use BaseDashboardTestTrait;

    public const API_GET = '/evrinoma/api/dashboard/status';
    public const API_CRITERIA = '/';
    public const API_DELETE = '/';
    public const API_PUT = '/';
    public const API_POST = '/';

    protected static function getDtoClass(): string
    {
        return static::class;
    }

    protected static function defaultData(): array
    {
        return [];
    }

    public function actionPost(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteria(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteriaNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPut(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPutUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDelete(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionDeleteUnprocessable(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGet(): void
    {
        $response = $this->queryGet([]);
        Assert::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->checkResult($response);
    }

    public function actionGetNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
