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
     * @var string
     */
    protected $desc;

    /**
     * @var integer
     */
    protected $postCounter;

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

    /**
     * @param string $desc
     * @return self
     */
    public function setDesc($desc = "")
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param int $counter
     * @return self
     */
    public function setPostCounter($counter = 0)
    {
        $this->postCounter = $counter;

        return $this;
    }

    /**
     * @return self
     */
    public function incrementPostCounter()
    {
        $this->postCounter++;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostCounter()
    {
        return $this->postCounter;
    }
}