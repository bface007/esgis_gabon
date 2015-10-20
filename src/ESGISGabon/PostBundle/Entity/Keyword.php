<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 02:56
 */

namespace ESGISGabon\PostBundle\Entity;

use BluEstuary\PostBundle\Model\Keyword as Base;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Keyword
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\Entity(repositoryClass="ESGISGabon\PostBundle\Entity\KeywordRepository")
 * @ORM\Table(name="esgis_post_keywords")
 */
class Keyword extends Base
{
    /**
     * @var
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="integer", name="posts_counter")
     */
    protected $postsCounter = 0;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="KeywordTagging", mappedBy="tag", fetch="EAGER")
     */
    protected $tagging;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }
}