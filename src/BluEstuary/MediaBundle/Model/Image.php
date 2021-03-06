<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 06:58
 */

namespace BluEstuary\MediaBundle\Model;


abstract class Image extends Media implements ImageInterface
{
    /**
     * @var string
     */
    protected $imageStatus;

    /**
     * @var array
     */
    protected $imageDimensions;

    /**
     * Sets image status ("default" or "cropped")
     *
     * @param string $imageStatus
     * @return self
     */
    public function setImageStatus($imageStatus = "default")
    {
        $this->imageStatus = $imageStatus;

        return $this;
    }

    /**
     * Gets image status
     *
     * @return string
     */
    public function getImageStatus()
    {
        return $this->imageStatus;
    }

    /**
     * Sets image dimensions (width and height)
     *
     * @param array $dimensions
     * @return self
     */
    public function setImageDimensions(array $dimensions)
    {
        $this->imageDimensions = $dimensions;

        return $this;
    }

    /**
     * Gets image dimensions
     *
     * @return array
     */
    public function getImageDimensions()
    {
        return $this->imageDimensions;
    }

    /**
     * Sets image width
     *
     * @param integer $width
     * @return self
     */
    public function setImageWidth($width)
    {
        if(null === $width || false === is_int($width) || $width <= 0)
            trigger_error("setImageWidth expected Argument to be an integer greater than 0", E_USER_ERROR);
        $dimensions = $this->imageDimensions || array();
        $dimensions[0] = $width;

        $this->imageDimensions = $dimensions;

        return $this;
    }

    /**
     * Gets image width
     *
     * @return integer
     */
    public function getImageWidth()
    {
        return $this->imageDimensions[0];
    }

    /**
     * Sets image height
     *
     * @param integer $height
     * @return self
     */
    public function setImageHeight($height)
    {
        if(null === $height || false === is_int($height) || $height <= 0)
            trigger_error("setImageHeight expected Argument to be an integer greater than 0", E_USER_ERROR);
        $dimensions = $this->imageDimensions || array();
        $dimensions[1] = $height;

        $this->imageDimensions = $dimensions;

        return $this;
    }

    /**
     * Gets image height
     *
     * @return integer
     */
    public function getImageHeight()
    {
        return $this->imageDimensions[1];
    }

    function __construct($width = null, $height = null)
    {
        if(null !== $width && (false === is_int($width) || $width <= 0))
            trigger_error("Image constructor expected Argument 1 to be an integer greater than 0 or null", E_USER_ERROR);
        if(null !== $height && (false === is_int($height) || $height <= 0))
            trigger_error("Image constructor expected Argument 2 to be an integer greater than 0 or null", E_USER_ERROR);
        if(null === $width && null !== $height)
            trigger_error("Image constructor expected Argument 1 to be not null if Argument 2 is not null", E_USER_ERROR);

        if(null === $height && null !== $width)
            $this->imageDimensions = array($width, $width);
        else if(null !== $width && null !== $height)
            $this->imageDimensions = array($width, $height);
    }


} 