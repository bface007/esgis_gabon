<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 01:26
 */

namespace ESGISGabon\PostBundle\Entity;

use BluEstuary\PostBundle\Model\Category as Base;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Category
 * @package ESGISGabon\PostBundle\Entity
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="ESGISGabon\PostBundle\Entity\CategoryRepository")
 * @ORM\Table(name="esgis_post_categories")
 */
class Category extends Base
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="category_name", nullable=false, length=30)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(length=30, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * @var string
     * @ORM\Column(length=255, name="category_desc", nullable=true, type="string")
     */
    protected $desc;

    /**
     * @var int
     * @ORM\Column(name="category_post_counter", type="integer")
     */
    protected $postCounter = 0;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    protected $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    protected $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    protected $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    protected $root;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    public function __construct($title = null)
    {
        parent::__construct($title);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLft()
    {
        return $this->lft;
    }

    public function getLvl()
    {
        return $this->lvl;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getRoot()
    {
        return $this->root;
    }
}