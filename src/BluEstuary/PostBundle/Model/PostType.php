<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 02/10/15
 * Time: 22:05
 */

namespace BluEstuary\PostBundle\Model;


class PostType
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    public function setTitle($title){
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}