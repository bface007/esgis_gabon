<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 19/10/15
 * Time: 15:43
 */

namespace BluEstuary\MediaBundle\Naming;


use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class DirectoryNamer implements DirectoryNamerInterface
{

    /**
     * Creates a directory name for the file being uploaded.
     *
     * @param object $object The object the upload is attached to.
     * @param Propertymapping $mapping The mapping to use to manipulate the given object.
     *
     * @return string The directory name.
     */
    public function directoryName($object, PropertyMapping $mapping)
    {
        $creationDate = $object->getCreationDate();

        return $creationDate->format('Y')."/".$creationDate->format('m');
    }
}