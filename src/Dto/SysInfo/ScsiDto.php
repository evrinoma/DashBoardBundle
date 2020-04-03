<?php


namespace Evrinoma\DashBoardBundle\Dto\SysInfo;


use Evrinoma\DashBoardBundle\Dto\SysInfoDto;

/**
 * Class ScsiDto
 *
 * @package Evrinoma\DashBoardBundle\Dto\SysInfo
 */
class ScsiDto
{
//region SECTION: Fields
    private $model = SysInfoDto::UNKNOWN;
    private $media = SysInfoDto::UNKNOWN;
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
     * @return ScsiDto
     */
    public function setModel(string $model):self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param string $media
     *
     * @return ScsiDto
     */
    public function setMedia(string $media):self
    {
        $this->media = $media;

        return $this;
    }
//endregion Getters/Setters

}