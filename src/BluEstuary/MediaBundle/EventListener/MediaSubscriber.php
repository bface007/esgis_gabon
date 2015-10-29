<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 19/10/15
 * Time: 20:30
 */

namespace BluEstuary\MediaBundle\EventListener;

use BluEstuary\MediaBundle\Model\ImageInterface;
use BluEstuary\MediaBundle\Model\MediaInterface;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Vich\UploaderBundle\Event\Events as VichEvents;
use Vich\UploaderBundle\Event\Event as VichEvent;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class MediaSubscriber implements EventSubscriber
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof MediaInterface){

            $file = $entity->getFile();

            $entity->setUpdateDate(new \DateTime());
            $entity->setCreationDate(new \DateTime());
            $entity->setMimeType($file->getMimeType());
            $entity->setFileSize($file->getSize());
            $entity->setFileExtension($file->getExtension());
            $entity->setOriginalFileName($file->getFilename());
            $entity->setOwner($this->getUser());

        }

    }

    protected function getUser()
    {
        return $this->container->get('security.context')->getToken()->getUser();
    }
}