<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 02:28
 */

namespace ESGISGabon\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FPN\TagBundle\Entity\Tagging as BaseTagging;

/**
 * Class Tagging
 * @package ESGISGabon\PostBundle\Entity
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="keyword_tagging_idx", columns={"tag_id", "resource_type", "resource_id"})})
 * @ORM\Entity
 */
class KeywordTagging extends BaseTagging
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Keyword", inversedBy="tagging")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     **/
    protected $tag;
}