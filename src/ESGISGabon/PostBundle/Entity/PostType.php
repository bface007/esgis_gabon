<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 02/10/15
 * Time: 22:10
 */

namespace ESGISGabon\PostBundle\Entity;

use BluEstuary\PostBundle\Model\PostType as Base;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class PostType
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="esgis_post_post_type")
 */
class PostType extends Base
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
     * @ORM\Column(type="string", name="title", nullable=false, length=25)
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(length=30, unique=true)
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    public function getId()
    {
        return $this->id;
    }
}