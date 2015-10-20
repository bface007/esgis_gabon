<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 26/09/15
 * Time: 02:48
 */

namespace ESGISGabon\PostBundle\Listener;


use BluEstuary\CoreBundle\BluEstuaryCoreBundle;
use Doctrine\ORM\Event\LifecycleEventArgs;
use ESGISGabon\PostBundle\Entity\Post;
use BluEstuary\CoreBundle\Helpers\StringHelper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PersistPost
{
    private $stringHelper;

    public function __construct(StringHelper $stringHelper){
        $this->stringHelper = $stringHelper;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        if($entity instanceof Post){
            if(trim($entity->getPostExcerpt()) === ''){
                $entity->setPostExcerpt(
                    $this->stringHelper
                        ->setContent($entity->getPostContent())
                        ->excerptContent()
                );
            }
        }
    }
}