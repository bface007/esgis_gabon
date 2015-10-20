<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 23:42
 */

namespace ESGISGabon\PostBundle\Entity;

use BluEstuary\PostBundle\Model\Post as Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * Class Post
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\MappedSuperclass
 */
class Post extends Base
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="creation_date", nullable=false)
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="update_date", nullable=false)
     */
    protected $updateDate;

    /**
     * @var
     * @ORM\Column(type="text", name="post_content", nullable=false)
     */
    protected $postContent;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_title", nullable=true, length=100)
     */
    protected $postTitle;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_excerpt", nullable=true, length=200)
     */
    protected $postExcerpt;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_status", nullable=false, length=20)
     */
    protected $postStatus = "draft";

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="ESGISGabon\PostBundle\Entity\PostType")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $postType;

    /**
     * @var
     * @ORM\Version
     * @ORM\Column(type="integer")
     */
    protected $version;

    /**
     * @var int
     * @ORM\Column(type="integer", name="views_counter")
     */
    protected $viewsCounter = 0;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="ESGISGabon\PostBundle\Entity\Category", cascade={"persist"})
     */
    protected $categories;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="ESGISGabon\PostBundle\Entity\Keyword", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $keywords;

    /**
     * @var OwnableInterface
     * @ORM\ManyToOne(targetEntity="ESGISGabon\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;

    public function __construct()
    {
        $this->keywords = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }
}