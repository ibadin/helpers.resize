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
    private $blur;
    private $resize_type = ImageResizeTypes::PROPORTIONAL;
    private $holderSize = "30x30";

    public static function withSize($size)
    {
        $instance = new self();
        $instance->size = $size;
        $instance->blur = new BlurSettings(5, 3);

        return $instance;
    }

    /**
     * @param mixed $blur
     * @return ImageSettings
     */
    public function setBlur($blur)
    {
        if (is_array($blur))
        {
            if (isset($blur["radius"]))
                $this->blur->setRadius($blur["radius"]);
            if (isset($blur["sigma"]))
                $this->blur->setSigma($blur["sigma"]);
        }
        else if (!$blur)
        {
            $this->blur = false;
        }
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