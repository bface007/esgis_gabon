<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 01:27
 */

namespace BluEstuary\PostBundle\Model;


use BluEstuary\CoreBundle\Model\CommonInterface;

interface CategoryInterface extends CommonInterface
{
    /**
     * Sets category title
     *
     * @param string $title
     * @return self
     */
    public function setName($name);

    /**
     * Gets category title
     *
     * @return string $title
     */
    public function getName();

    /**
     * Gets category slug
     *
     * @return string $slug
     */
    public function getSlug();

    /**
     * Gets category parent
     *
     * @return CategoryInterface|null $parent
     */
    public function getParent();
}