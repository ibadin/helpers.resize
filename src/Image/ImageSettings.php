<?php
/**
 * Created by PhpStorm.
 * User: igorbadin
 * Date: 16.08.18
 * Time: 22:40
 */

namespace Pxl\Helpers\Image;


class ImageSettings
{
    private $size;
    private $blur = true;
    private $resize_type = ImageResizeTypes::PROPORTIONAL;
    private $holderSize = "30x30";

    public static function withSize($size)
    {
        $instance = new self();
        $instance->size = $size;

        return $instance;
    }

    /**
     * @param bool $blur
     * @return ImageSettings
     */
    public function setBlur($blur)
    {
        $this->blur = $blur;
        return $this;
    }

    /**
     * @param int $resize_type
     * @return ImageSettings
     */
    public function setResizeType($resize_type)
    {
        $this->resize_type = $resize_type;
        return $this;
    }

    /**
     * @param mixed $holderSize
     * @return ImageSettings
     */
    public function setHolderSize($holderSize)
    {
        $this->holderSize = $holderSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function getBlur()
    {
        return $this->blur;
    }

    /**
     * @return int
     */
    public function getResizeType()
    {
        return $this->resize_type;
    }

    /**
     * @return mixed
     */
    public function getHolderSize()
    {
        return $this->holderSize;
    }

    /**
     * @param mixed $size
     * @return ImageSettings
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

}