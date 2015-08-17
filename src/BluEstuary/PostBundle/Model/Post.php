<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 18:17
 */

namespace BluEstuary\PostBundle\Model;


use BluEstuary\CoreBundle\Model\ModulableInterface;
use BluEstuary\CoreBundle\Model\ModuleInterface;
use BluEstuary\UserBundle\Model\OwnableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Post implements PostInterface, ModulableInterface, OwnableInterface
{

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
    protected $postContent;

    /**
     * @var string
     */
    protected $postTitle;

    /**
     * @var string
     */
    protected $postExcerpt;

    /**
     * @var string
     */
    protected $postStatus;

    /**
     * @var string
     */
    protected $postType;

    /**
     * @var OwnableInterface
     */
    protected $owner;

    /**
     * @var ModuleInterface
     */
    protected $module;

    /**
     * Sets post creation date
     *
     * @param \DateTime $creationDate
     * @return self
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Gets post creation date
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Sets post update date
     *
     * @param \DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Gets post update date
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Sets post content
     *
     * @param string $postContent
     * @return self
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Gets post content
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Sets post title
     *
     * @param string $postTitle
     * @return self
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Gets post title
     *
     * @return string
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Sets the post excerpt
     *
     * @param string $postExcerpt
     * @return self
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;

        return $this;
    }

    /**
     * Gets the post excerpt
     *
     * @return string
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
    }

    /**
     * Sets post status
     *
     * @param string $postStatus
     * @return self
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Gets post status
     *
     * @return string
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Gets post type
     *
     * @return string
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Sets post type
     *
     * @param string $postType
     * @return self
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;

        return $this;
    }

    /**
     * Sets module
     *
     * @param ModuleInterface $module
     * @return self
     */
    public function setModule(ModuleInterface $module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Gets module
     *
     * @return ModuleInterface
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Gets module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->module->getName();
    }

    /**
     * Gets module code
     *
     * @return string
     */
    public function getModuleCode()
    {
        return $this->module->getCode();
    }

    /**
     * Sets post owner
     *
     * @param UserInterface $owner
     * @return self
     */
    public function setOwner(UserInterface $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Gets post owner
     *
     * @return OwnableInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }
}