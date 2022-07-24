<?php

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
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $product
     *
     * @return DevStd
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param mixed $serialNumber
     *
     * @return DevStd
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }



}