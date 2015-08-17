<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 06:32
 */

namespace BluEstuary\MediaBundle\Model;


interface ImageInterface extends MediaInterface
{
    /**
     * Sets image status
     *
     * @param string $imageStatus
     * @return self
     */
    public function setImageStatus($imageStatus);

    /**
     * Gets image status
     * @return string
     */
    public function getImageStatus();

    /**
     * Sets image dimensions (width and height)
     *
     * @param array $dimensions
     * @return self
     */
    public function setImageDimensions(array $dimensions);

    /**
     * Gets image dimensions
     *
     * @return array
     */
    public function getImageDimensions();

    /**
     * Sets image width
     *
     * @param integer $width
     * @return self
     */
    public function setImageWidth($width);

    /**
     * Gets image width
     *
     * @return integer
     */
    public function getImageWidth();

    /**
     * Sets image height
     *
     * @param integer $height
     * @return self
     */
    public function setImageHeight($height);

    /**
     * Gets image height
     *
     * @return integer
     */
    public function getImageHeight();
} 