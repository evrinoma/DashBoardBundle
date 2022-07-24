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

namespace Evrinoma\DashBoardBundle\Core;

use Evrinoma\DashBoardBundle\Model\SizeModel;

/**
 * Trait SizeTrait.
 */
trait SizeTrait
{
    private $size = SizeModel::SYZE_IN_BYTE;

    public function sizeInByte()
    {
        $this->size = SizeModel::SYZE_IN_BYTE;

        return $this;
    }

    public function sizeInKiloByte()
    {
        $this->size = SizeModel::SYZE_IN_KILOBYTE;

        return $this;
    }

    public function sizeInMegaByte()
    {
        $this->size = SizeModel::SYZE_IN_MEGABYTE;

        return $this;
    }

    public function sizeInGigaByte()
    {
        $this->size = SizeModel::SYZE_IN_GIGABYTE;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    public function getLetter()
    {
        $letter = 'Byte';

        switch ($this->size) {
            case SizeModel::SYZE_IN_GIGABYTE:
                $letter = 'G'.$letter;
                break;
            case SizeModel::SYZE_IN_MEGABYTE:
                $letter = 'M'.$letter;
                break;
            case SizeModel::SYZE_IN_KILOBYTE:
                $letter = 'k'.$letter;
                break;
        }

        return $letter;
    }
}
