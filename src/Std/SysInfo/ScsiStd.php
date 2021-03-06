<?php


namespace Evrinoma\DashBoardBundle\Std\SysInfo;


use Evrinoma\DashBoardBundle\Std\SysInfoStd;

class ScsiStd
{
//region SECTION: Fields
    private $model = SysInfoStd::UNKNOWN;
    private $media = SysInfoStd::UNKNOWN;
//endregion Fields

//region SECTION: Getters/Setters
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
//endregion Getters/Setters

}