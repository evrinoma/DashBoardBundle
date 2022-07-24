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

namespace Evrinoma\DashBoardBundle\Model;

/**
 * Class SizeModel.
 */
abstract class SizeModel
{
    public const SYZE_IN_BYTE = 1;
    public const SYZE_IN_KILOBYTE = 1000;
    public const SYZE_IN_MEGABYTE = 1000000;
    public const SYZE_IN_GIGABYTE = 1000000000;
}
