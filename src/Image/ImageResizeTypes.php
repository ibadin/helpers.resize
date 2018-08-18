<?php
/**
 * Created by PhpStorm.
 * User: igorbadin
 * Date: 16.08.18
 * Time: 22:46
 */

namespace Pxl\Helpers\Image;


class ImageResizeTypes
{
    /** Масштабирует в прямоугольник $size c сохранением пропорций, обрезая лишнее */
    const CROP = BX_RESIZE_IMAGE_EXACT;

    /** Масштабирует с сохранением пропорций, размер ограничивается $size; */
    const PROPORTIONAL = BX_RESIZE_IMAGE_PROPORTIONAL;

    /** Масштабирует с сохранением пропорций за ширину при этом принимается максимальное значение из высоты/ширины,
     * размер ограничивается $size, улучшенная обработка вертикальных картинок.
     */
    const PROPORTIONAL_ALT = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
}