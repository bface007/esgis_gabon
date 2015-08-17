<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 23:42
 */

namespace ESGISGabon\PostBundle\Entity;

use BluEstuary\PostBundle\Model\Post as Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\MappedSuperclass
 */
class Post extends Base
{

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="creation_date", nullable=false)
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="update_date", nullable=false)
     */
    protected $updateDate;

    /**
     * @var
     * @ORM\Column(type="text", name="post_content", nullable=true)
     */
    protected $postContent;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_title", nullable=false, length=250)
     */
    protected $postTitle;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_excerpt", nullable=false, length=200)
     */
    protected $postExcerpt;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_status", nullable=false, length=20)
     */
    protected $postStatus;

    /**
     * @var string
     * @ORM\Column(type="string", name="post_type", nullable=true, length=20)
     */
    protected $postType;

    /**
     * @var OwnableInterface
     * @ORM\ManyToOne(targetEntity="ESGISGabon\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;

    /**
     * @var ModuleInterface
     * @ORM\ManyToOne(targetEntity="ESGISGabon\MainBundle\Entity\Module")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $module;
} 