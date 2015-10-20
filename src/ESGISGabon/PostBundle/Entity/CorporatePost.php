<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/08/15
 * Time: 17:17
 */

namespace ESGISGabon\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Taggable\Doctrine;
use DoctrineExtensions\Taggable\Taggable;
use Gedmo\Mapping\Annotation as Gedmo;
use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class BlogPost
 * @package ESGISGabon\PostBundle\Entity
 * @ORM\Entity(repositoryClass="ESGISGabon\PostBundle\Entity\CorporatePostRepository")
 * @ORM\Table(name="esgis_corporate_post")
 * @Hateoas\Relation("self", href= @Hateoas\Route("api_get_posts", parameters = {"id" = "expr(object.getId())"}))
 */
class CorporatePost extends Post implements Taggable
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
     * @ORM\Column(length=128, unique=true)
     * @Gedmo\Slug(fields={"postTitle"})
     */
    protected $slug;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="creation_date", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="update_date", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updateDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="content_changed", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"postTitle", "postContent"})
     */
    protected $contentChanged;

    /**
     * @var \ESGISGabon\MediaBundle\Entity\Image
     * @ORM\ManyToOne(targetEntity="ESGISGabon\MediaBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $cover;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getContentChanged()
    {
        return $this->contentChanged;
    }

    /**
     * @param \ESGISGabon\MediaBundle\Entity\Media|null $media
     * @return self
     */
    public function setCover(\ESGISGabon\MediaBundle\Entity\Media $media = null)
    {
        $this->cover = $media;

        return $this;
    }

    /**
     * @return \ESGISGabon\MediaBundle\Entity\Media
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Returns the unique taggable resource type
     *
     * @return string
     */
    public function getTaggableType()
    {
        return 'corporate_post_keywords';
    }

    /**
     * Returns the unique taggable resource identifier
     *
     * @return string
     */
    public function getTaggableId()
    {
        return $this->getId();
    }

    /**
     * Returns the collection of tags for this Taggable entity
     *
     * @return ArrayCollection
     */
    public function getTags()
    {
        $this->keywords = $this->keywords ?: new ArrayCollection();

        return $this->keywords;
    }

    public function setKeywords(ArrayCollection $keywords = null)
    {
        if(is_null($keywords))
            $keywords = new ArrayCollection();

        $this->keywords = $keywords;

        return $this;
    }
}