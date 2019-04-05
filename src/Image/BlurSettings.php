<?php

namespace Pxl\Helpers\Image;


class BlurSettings
{
    private $radius;
    private $sigma;

    /**
     * @param float $radius
     * @param float $sigma
     */
    function __construct($radius, $sigma)
    {
        $this->radius = $radius;
        $this->sigma = $sigma;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return float
     */
    public function getSigma()
    {
        return $this->sigma;
    }

    /**
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @param float $sigma
     */
    public function setSigma($sigma)
    {
        $this->sigma = $sigma;
    }
}