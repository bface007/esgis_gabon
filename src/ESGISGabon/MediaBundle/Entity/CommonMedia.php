<?php
/**
 * Created by PhpStorm.
 * User: bface
 * Date: 03/08/2015
 * Time: 22:57
 */

namespace ESGISGabon\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BluEstuary\MediaBundle\Model\Media as Base;

/**
 * Class Media
 * @package ESGISGabon\MediaBundle\Entity
 * @ORM\MappedSuperclass
 */
class CommonMedia extends Base
{


    /**
     * @var string
     * @ORM\Column(type="string", name="media_location", length=50, nullable=true)
     */
    protected $location;

    /**
     * @var string
     * @ORM\Column(type="string", name="file_name", length=30, nullable=false)
     */
    protected $fileName;

    /**
     * @var string
     * @ORM\Column(type="string", name="original_name", length=30, nullable=false)
     */
    protected $originalFileName;

    /**
     * @var string
     * @ORM\Column(type="string", name="mime_type", length=15, nullable=false)
     */
    protected $mimeType;

    /**
     * @var int
     * @ORM\Column(type="integer", name="file_size", nullable=false)
     */
    protected $fileSize;

    /**
     * @var string
     * @ORM\Column(type="string", name="file_extension", length=5, nullable=false)
     */
    protected $fileExtension;

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
     * @var string
     * @ORM\Column(type="string", name="file_url", length=255, unique=true, nullable=false)
     */
    protected $fileUrl;

    /**
     * @var \ESGISGabon\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="ESGISGabon\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;

}
