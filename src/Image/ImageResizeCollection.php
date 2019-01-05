<?php

namespace Pxl\Helpers\Image;


class ImageResizeCollection
{
    private $arImageIds;
    private $arSettings;

    private function __construct($arImageIds)
    {
        $this->arImageIds = $arImageIds;
    }

    public static function byIds($arImageIds)
    {
        $instance = new self($arImageIds);
        return $instance;
    }

    public function addSize($sizeName, ImageSettings $settings)
    {
        $this->arSettings[$sizeName] = $settings;
        return $this;
    }

    public function resize()
    {
        foreach ($this->arImageIds as $id)
            /**
             * @var  $sizeName
             * @var ImageSettings $settings
             */
            foreach ($this->arSettings as $sizeName => $settings) {
                $arImages[$id][$sizeName] = ImageResize::init($id, $settings)->resize();
            }

        return $arImages;
    }
}