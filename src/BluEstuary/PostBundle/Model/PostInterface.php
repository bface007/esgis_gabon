<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 05:32
 */

namespace BluEstuary\PostBundle\Model;


use BluEstuary\CoreBundle\Model\CommonInterface;

interface PostInterface extends CommonInterface
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
    public function setPostType($postType);

    /**
     * Gets post type
     *
     * @return string
     */
    public function getPostType();


} 