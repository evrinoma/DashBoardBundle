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

class DevStd
{
    private $description;
    private $product;
    private $serialNumber;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @param mixed $description
     *
     * @return DevStd
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $product
     *
     * @return DevStd
     */
    public function setProduct($product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param mixed $serialNumber
     *
     * @return DevStd
     */
    public function setSerialNumber($serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }
}
