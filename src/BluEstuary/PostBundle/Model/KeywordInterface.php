<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 02:00
 */

namespace BluEstuary\PostBundle\Model;


use BluEstuary\CoreBundle\Model\CommonInterface;

interface KeywordInterface extends CommonInterface
{
    /**
     * Sets keyword title
     *
     * @param string $title
     * @return self
     */
    public function setName($name);

    /**
     * Gets keyword title
     *
     * @return string
     */
    public function getName();

    /**
     * Gets keyword slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Increments keyword posts counter
     *
     * @return self
     */
    public function incrementPostsCounter();

    /**
     * Gets keyword posts counter
     *
     * @return integer
     */
    public function getPostsCounter();
}