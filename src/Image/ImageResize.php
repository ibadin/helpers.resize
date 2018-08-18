<?php


namespace Pxl\Helpers\Image;

use Bitrix\Main\Application;

class ImageResize
{
    private $id;
    private $settings;

    private function __construct($id, ImageSettings $settings)
    {
        $this->id = $id;
        $this->settings = $settings;
    }

    public static function init($id, ImageSettings $settings)
    {
        $instance = new self($id, $settings);
        return $instance;
    }

    public function resize()
    {
        $arImage = \CFile::ResizeImageGet($this->id, $this->getSizeArray($this->settings->getSize()), $this->settings->getResizeType(), true, $this->getFilter());
        $arResize["IMAGE"] = $this->toImageArray($arImage);

        if ($this->settings->getBlur()) {
            $arHolder = $this->getPlaceholder();
            $arResize["HOLDER"] = $this->toImageArray($arHolder);
        }

        return $arResize;
    }

    private function getSizeArray($size)
    {
        list($width, $height) = explode("x", $size);

        return [
            "width" => $width,
            "height" => $height,
        ];
    }

    private function getFilter()
    {
        return [
            "name" => "sharpen",
            "precision" => 15
        ];
    }

    private function getPlaceholder()
    {
        $arSmall = \CFile::ResizeImageGet($this->id, $this->getSizeArray($this->settings->getHolderSize()), ImageResizeTypes::CROP, true, $this->getFilter());
        $this->blurPhoto($arSmall['src']);

        return $arSmall;

    }

    private function toImageArray(array $arImage)
    {
        return [
            "BASE64" => $this->toBase64(Application::getDocumentRoot() . $arImage["src"]),
            "SRC" => $arImage["src"],
            "WIDTH" => $arImage["width"],
            "HEIGHT" => $arImage["height"],
            "SIZE" => $arImage["size"],
        ];
    }

    /**
     * @param bool $blur
     * @return ImageResize
     */
    public function setBlur($blur)
    {
        $this->settings->setBlur($blur);
        return $this;
    }

    /**
     * @param int $resizeType
     * @return ImageResize
     */
    public function setResizeType($resizeType)
    {
        $this->settings->setResizeType($resizeType);
        return $this;
    }

    /**
     * @param string $holderSize
     * @return ImageResize
     */
    public function setHolderSize($holderSize)
    {
        $this->settings->setHolderSize($holderSize);
        return $this;
    }


    public function blurPhoto($src)
    {
        try {
            $image = new \Imagick(Application::getDocumentRoot() . $src);
            $image->blurImage(5, 3);
            $image->writeImage(Application::getDocumentRoot() . $src);
        } catch (\ImagickException $e) {
            //nothing to do
        }
    }

    private function toBase64($img)
    {
        $imageSize = getimagesize($img);
        $imageData = base64_encode(file_get_contents($img));
        $imageHTML = "data:{$imageSize['mime']};base64,{$imageData}";
        return $imageHTML;
    }

}

//function insert_base64_encoded_image($img, $echo = false)
//{
//    $imageSize = getimagesize($img);
//    $imageData = base64_encode(file_get_contents($img));
//    $imageHTML = "data:{$imageSize['mime']};base64,{$imageData}";
//    if ($echo == true) {
//        echo $imageHTML;
//    } else {
//        return $imageHTML;
//    }
//}