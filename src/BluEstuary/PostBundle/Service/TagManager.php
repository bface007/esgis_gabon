<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 03:48
 */

namespace BluEstuary\PostBundle\Service;

use Doctrine\ORM\EntityManager;
use DoctrineExtensions\Taggable\Entity\Tag;
use DoctrineExtensions\Taggable\Taggable;
use FPN\TagBundle\Entity\TagManager as BaseManager;
use FPN\TagBundle\Util\SlugifierInterface;
use Doctrine\ORM\Query;

class TagManager extends BaseManager
{
    public function __construct(EntityManager $em, $tagClass = null, $taggingClass = null, SlugifierInterface $slugifier)
    {
        parent::__construct($em, $tagClass, $taggingClass, $slugifier);
    }

    protected function createTag($name)
    {
        $tag = parent::createTag($name);
        if(is_null($tag->getCreatedAt()))
            $tag->setCreatedAt(new \DateTime());
        if(is_null($tag->getUpdatedAt()))
            $tag->setUpdatedAt(new \DateTime());

        return $tag;
    }

    public function getTagsNamesSeparated(array $tags, $separator = ', ')
    {
        return join($separator, $tags);
    }


    /**
     * Search for tags
     *
     * @param string $search
     * @return array
     */
    public function findTags($search)
    {
        return $this->em
            ->createQueryBuilder()
            ->select('t.name')
            ->from($this->tagClass, 't')
            ->where('t.slug LIKE :search')
            ->setParameter('search', strtolower('%' . $search . '%'))
            ->setMaxResults(5)
            ->orderBy('t.name')
            ->getQuery()
            ->getResult(Query::HYDRATE_SCALAR)
            ;
    }
}