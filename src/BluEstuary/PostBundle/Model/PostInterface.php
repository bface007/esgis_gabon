<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 05:32
 */

namespace BluEstuary\PostBundle\Model;


use BluEstuary\CoreBundle\Model\CommonInterface;
use BluEstuary\UserBundle\Model\OwnableInterface;

interface PostInterface extends OwnableInterface
{
    /**
     * Sets post creation date
     *
     * @param \DateTime $creationDate
     * @return self
     */
    public function setCreationDate(\DateTime $creationDate);

    /**
     * Gets post creation date
     *
     * @return \DateTime
     */
    public function getCreationDate();

    /**
     * Sets post update date
     *
     * @param \DateTime $updateDate
     * @return self
     */
    public function setUpdateDate(\DateTime $updateDate);

    /**
     * Gets post update date
     *
     * @return \DateTime
     */
    public function getUpdateDate();

    /**
     * Sets post content
     *
     * @param string $postContent
     * @return self
     */
    public function setPostContent($postContent);

    /**
     * Gets post content
     *
     * @return string
     */
    public function getPostContent();

    /**
     * Sets post title
     *
     * @param string $postTitle
     * @return self
     */
    public function setPostTitle($postTitle);

    /**
     * Gets post title
     *
     * @return string
     */
    public function getPostTitle();

    /**
     * Sets the post excerpt
     *
     * @param string $postExcerpt
     * @return self
     */
    public function setPostExcerpt($postExcerpt);

    /**
     * Gets the post excerpt
     *
     * @return string
     */
    public function getPostExcerpt();

    /**
     * Sets post status
     *
     * @param string $postStatus
     * @return self
     */
    public function setPostStatus($postStatus);

    /**
     * Gets post status
     *
     * @return string
     */
    public function getPostStatus();

    /**
     * Sets post type
     *
     * @param string $postType
     * @return self
     */
    public function setPostType(\BluEstuary\PostBundle\Model\PostType $postType);

    /**
     * Gets post type
     *
     * @return string
     */
    public function getPostType();

    /**
     * Sets post slug
     *
     * @param string $slug
     * @return self
     */
    public function setSlug($slug);

    /**
     * Gets post slug
     * 
     * @return string
     */
    public function getSlug();

    /**
     * Add post category
     *
     * @param CategoryInterface $category
     * @return self
     */
    public function addCategory(\BluEstuary\PostBundle\Model\Category $category);

    /**
     * Remove post category
     *
     * @param CategoryInterface $category
     * @return self
     */
    public function removeCategory(\BluEstuary\PostBundle\Model\Category $category);

    /**
     * Gets post categories
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCategories();

    /**
     * Add post keyword
     *
     * @param KeywordInterface $keyword
     * @return self
     */
    public function addKeyword(\BluEstuary\PostBundle\Model\Keyword $keyword);

    /**
     * Remove post keyword
     *
     * @param KeywordInterface $keyword
     * @return self
     */
    public function removeKeyword(\BluEstuary\PostBundle\Model\Keyword $keyword);

    /**
     * Gets post keywords
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getKeywords();
} 