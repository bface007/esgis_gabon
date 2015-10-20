<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 18:16
 */

namespace BluEstuary\PostBundle\EventListener;

use BluEstuary\PostBundle\Model\PostInterface;
use BluEstuary\PostBundle\Service\CategoryManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class PostSubscriber implements EventSubscriber
{
    protected $container;
    protected $categoryManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getCategoryManager()
    {
        if(!$this->categoryManager)
            $this->categoryManager = $this->container->get('blu_es_post.category_manager');

        return $this->categoryManager;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            //Events::onFlush,
            Events::prePersist
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();


        if($entity instanceof PostInterface){

            if($entity->getCategories()->isEmpty()){
                $entity->addCategory($this->getCategoryManager()->loadOrCreateCategory("Non classé"));
            }else{
                throw new \RuntimeException("contains");
            }


            $keywords = $entity->getKeywords();
            if(!$keywords->isEmpty()){
                foreach($keywords as $keyword){
                    $keyword->incrementPostsCounter();

                    $em->persist($keyword);
                }

                $em->flush();
            }
        }
    }
}