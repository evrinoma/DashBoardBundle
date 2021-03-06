<?php

namespace Evrinoma\DashBoardBundle\Core;


use Evrinoma\DashBoardBundle\Model\SizeModel;

/**
 * Trait SizeTrait
 *
 * @package Evrinoma\DashBoardBundle\Core
 */
trait SizeTrait
{

//region SECTION: Fields
    private $size = SizeModel::SYZE_IN_BYTE;
//endregion Fields

//region SECTION: Public
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
//endregion Public

//region SECTION: Getters/Setters
    public function getLetter()
    {
        $letter = 'Byte';

        switch ($this->size) {
            case SizeModel::SYZE_IN_GIGABYTE :
                $letter = 'G'.$letter;
                break;
            case SizeModel::SYZE_IN_MEGABYTE :
                $letter = 'M'.$letter;
                break;
            case SizeModel::SYZE_IN_KILOBYTE :
                $letter = 'k'.$letter;
                break;
        }

        return $letter;
    }
//endregion Getters/Setters
}