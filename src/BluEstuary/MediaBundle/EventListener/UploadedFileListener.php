<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 21/10/15
 * Time: 02:15
 */

namespace BluEstuary\MediaBundle\EventListener;

use BluEstuary\MediaBundle\Model\ImageInterface;
use Vich\UploaderBundle\Event\Event;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


/**
 * Class UploadedFileListener
 * @package BluEstuary\MediaBundle\EventListener
 */
class UploadedFileListener
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param Event $event
     */
    public function onPostUpload(Event $event)
    {
        $entity = $event->getObject();
        $mapping = $event->getMapping();

        if($entity instanceof ImageInterface){
            $fileLocation = $this->getStorage()->resolvePath($entity, 'file', null, true);

            list($width, $height) = getimagesize($this->getUploadDir().'/'.$fileLocation);

            $entity->setImageDimensions(array($width, $height));
        }
    }

    /**
     * @return \Vich\UploaderBundle\Storage\GaufretteStorage
     */
    protected function getStorage()
    {
        return $this->container->get('vich_uploader.storage');
    }

    /**
     * @return mixed
     */
    protected function getUploadDir()
    {
        return $this->container->getParameter('upload_dir');
    }
}