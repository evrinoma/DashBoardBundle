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

namespace Evrinoma\DashBoardBundle\Std\SysInfo;

use Evrinoma\DashBoardBundle\Std\SysInfoStd;

class ScsiStd
{
    private string $model = SysInfoStd::UNKNOWN;
    private string $media = SysInfoStd::UNKNOWN;

    public function getModel(): string
    {
        return $this->model;
    }

    public function getMedia(): string
    {
        return $this->media;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }
}
