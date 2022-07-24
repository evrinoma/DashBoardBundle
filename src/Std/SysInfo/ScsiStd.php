<?php


namespace Evrinoma\DashBoardBundle\Std\SysInfo;


use Evrinoma\DashBoardBundle\Std\SysInfoStd;

class ScsiStd
{

    private $model = SysInfoStd::UNKNOWN;
    private $media = SysInfoStd::UNKNOWN;



    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return $this->media;
    }

    /**
     * @param string $model
     *
     * @return ScsiStd
     */
    public function setModel(string $model):self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string $media
     *
     * @return ScsiStd
     */
    public function setMedia(string $media):self
    {
        $this->media = $media;

        return $this;
    }


}