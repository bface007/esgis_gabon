<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 04:58
 */
namespace BluEstuary\MediaBundle\Model;

use BluEstuary\CoreBundle\Model\CommonInterface;
use BluEstuary\UserBundle\Model\OwnableInterface;
use BluEstuary\UserBundle\Model\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\File\File;

interface MediaInterface extends CommonInterface, OwnableInterface
{
    /**
     * Sets the file location
     *
     * @param string $location
     * @return self
     */
    public function setLocation($location);

    /**
     * Gets the file location
     *
     * @return string
     */
    public function getLocation();

    /**
     * Sets the filename
     *
     * @param string $filename
     * @return self
     */
    public function setFileName($filename);

    /**
     * Gets filename
     *
     * @return string
     */
    public function getFileName();

    /**
     * Sets the original file name
     *
     * @param string $originalFileName
     * @return self
     */
    public function setOriginalFileName($originalFileName);

    /**
     * Gets the original file name
     *
     * @return string
     */
    public function getOriginalFileName();

    /**
     * Sets the file mime type
     *
     * @param string $mimeType
     * @return self
     */
    public function setMimeType($mimeType);

    /**
     * Gets the file mime type
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Sets the file size in bytes
     *
     * @param integer $fileSize
     * @return self
     */
    public function setFileSize($fileSize);

    /**
     * Gets the file size in bytes
     *
     * @return integer
     */
    public function getFileSize();

    /**
     * Gets a user-friendly formatted file size
     *
     * @return string
     */
    public function getFormattedFileSize();

    /**
     * Sets the file extension
     *
     * @param string $fileExtension
     * @return self
     */
    public function setFileExtension($fileExtension);

    /**
     * Gets the file extension
     *
     * @return string
     */
    public function getFileExtension();

    /**
     * Sets the creation date of the file
     *
     * @param \DateTime $creationDate
     * @return self
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * Gets the creation date of the file
     *
     * @return null|\DateTime
     */
    public function getCreationDate();

    /**
     * Sets the update date of the file
     *
     * @param null|\DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate);

    /**
     * Gets the update date of the file
     *
     * @return null|\DateTime
     */
    public function getUpdateDate();

    /**
     * Sets the url of the file
     *
     * @param string $fileUrl
     * @return self
     */
    public function setFileUrl($fileUrl);

    /**
     * Gets the url of the file
     *
     * @return string
     */
    public function getFileUrl();

    /**
     * @param File|null $file
     * @return self
     */
    public function setFile(File $file = null);

    /**
     * @return File|null
     */
    public function getFile();

    /**
     * @param UserInterface|null $user
     * @return self
     */
    public function setOwner(UserInterface $user);

    /**
     * @return UserInterface|null
     */
    public function getOwner();
}