<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 02:06
 */

namespace BluEstuary\PostBundle\Model;

use FPN\TagBundle\Entity\Tag as BaseTag;


class Keyword extends BaseTag implements KeywordInterface
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
    protected $postsCounter;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    /**
     * Sets keyword title
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets keyword title
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets keyword slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Increments keyword posts counter
     *
     * @return self
     */
    public function incrementPostsCounter()
    {
        $this->postsCounter++;

        return $this;
    }

    /**
     * Gets keyword posts counter
     *
     * @return integer
     */
    public function getPostsCounter()
    {
        return $this->postsCounter;
    }

    /**
     * @return string|null
     */
    public function getDesc()
    {
        return $this->desc;
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
}