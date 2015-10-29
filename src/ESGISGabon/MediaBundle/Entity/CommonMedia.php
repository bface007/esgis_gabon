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
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Media
 * @package ESGISGabon\MediaBundle\Entity
 * @ORM\MappedSuperclass
 * @Vich\Uploadable
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
     * @ORM\Column(type="string", name="file_name", length=30, nullable=true)
     */
    protected $fileName;

    /**
     * @var string
     * @ORM\Column(type="string", name="original_name", length=30, nullable=true)
     */
    protected $originalFileName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @var File
     * @Vich\UploadableField(mapping="media_gallery", fileNameProperty="fileUrl")
     */
    protected $file;

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
     * @ORM\Column(type="string", name="file_url", length=255, unique=true, nullable=true)
     */
    protected $fileUrl;

    /**
     * @var \ESGISGabon\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="ESGISGabon\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $owner;


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     * @return $this
     */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if($file){
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updateDate = new \DateTime();
        }

        return $this;
    }

}
