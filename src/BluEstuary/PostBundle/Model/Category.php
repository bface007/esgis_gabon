<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 01:34
 */

namespace BluEstuary\PostBundle\Model;


class Category implements CategoryInterface
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var CategoryInterface|null
     */
    protected $parent;

    public function __construct($name = null)
    {
        $this->setName($name);
    }
    /**
     * Sets category title
     *
     * @param string $title
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets category title
     *
     * @return string $title
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets category slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets category parent
     *
     * @param Category|null $parent
     * @return self
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Gets category parent
     *
     * @return CategoryInterface|null $parent
     */
    public function getParent()
    {
        return $this->parent;
    }
}