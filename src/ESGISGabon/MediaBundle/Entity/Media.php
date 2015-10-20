<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 05/08/2015
 * Time: 21:10
 */

namespace ESGISGabon\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Media
 * @package ESGISGabon\MediaBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="esgis_media")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({ "image" = "Image", "media" = "Media"})
 * @Vich\Uploadable
 */
class Media extends CommonMedia
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
} 