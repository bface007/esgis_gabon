<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 07:00
 */

namespace BluEstuary\MediaBundle\Model;


use BluEstuary\UserBundle\Model\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class Media
 * @package BluEstuary\MediaBundle\Model
 *
 */
abstract class Media implements MediaInterface
{
    protected $id;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var File
     */
    protected $file;

    /**
     * @var string
     */
    protected $originalFileName;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var integer
     */
    protected $fileSize;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var \DateTime
     */
    protected $updateDate;

    /**
     * @var string
     */
    protected $fileUrl;

    /**
     * @var UserInterface
     */
    protected $owner;


    public function __construct(){
        $this->creationDate = new \DateTime();
        $this->updateDate = new \DateTime();
    }

    /**
     * Gets entity id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the filename
     *
     * @param string $filename
     * @return self
     */
    public function setFileName($filename)
    {
        $this->fileName = $filename;

        return $this;
    }

    /**
     * Gets filename
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Sets the original file name
     *
     * @param string $originalFileName
     * @return self
     */
    public function setOriginalFileName($originalFileName)
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    /**
     * Gets the original file name
     *
     * @return string
     */
    public function getOriginalFileName()
    {
        return $this->originalFileName;
    }

    /**
     * Sets the file mime type
     *
     * @param string $mimeType
     * @return self
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Gets the file mime type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Sets the file size in bytes
     *
     * @param integer $fileSize
     * @return self
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Gets the file size in bytes
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Gets a user-friendly formatted file size
     *
     * @return string
     */
    public function getFormattedFileSize()
    {
        $size = $this->fileSize;
        if($size < 1024)
            return $size ." o";
        else{
            $size /= 1024;
            if($size < 1024)
                return round($size, 1) ." Ko";
            else
                return round(($size / 1024), 1) ." Mo";
        }
    }

    /**
     * Sets the file extension
     *
     * @param string $fileExtension
     * @return self
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * Gets the file extension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Sets the creation date of the file
     *
     * @param null|\DateTime $creationDate
     * @return self
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Gets the creation date of the file
     *
     * @return null|\DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Sets the update date of the file
     *
     * @param null|\DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate = null)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Gets the update date of the file
     *
     * @return null|\DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Sets the url of the file
     *
     * @param string $fileUrl
     * @return self
     */
    public function setFileUrl($fileUrl)
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    /**
     * Gets the url of the file
     *
     * @return string
     */
    public function getFileUrl()
    {
        return $this->fileUrl;
    }


    /**
     * Sets the file location
     *
     * @param string $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Gets the file location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     * @return $this
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UserInterface $owner
     * @return self
     */
    public function setOwner(UserInterface $owner){
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getOwner(){
        return $this->owner;
    }
}