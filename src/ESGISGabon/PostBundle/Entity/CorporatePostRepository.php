<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 21/09/15
 * Time: 15:30
 */

namespace ESGISGabon\PostBundle\Entity;


use Doctrine\ORM\EntityRepository;

class CorporatePostRepository extends EntityRepository
{
    public function countPosts(){
        $q = $this->createQueryBuilder('p')
                    ->select('count(p)')
                    ->getQuery();

        return $q->getSingleScalarResult();
    }

    public function getPosts($format)
    {
        switch($format){
            case "lite":
                return $this->getLitePosts();
            break;
            case "medium":
                return null;
            break;
        }
        return null;
    }

    private function getLitePosts(){
        $query = $this->createQueryBuilder('p')
            ->select('partial p.{id, updateDate, viewsCounter, postStatus, postType, postTitle}')
            ->leftJoin('p.categories', 'c')
            ->addSelect('partial c.{id, name, slug}')
            ->leftJoin('p.keywords', 'k')
            ->addSelect('partial k.{id, name, slug}')
            ->leftJoin('p.owner', 'o')
            ->addSelect('partial o.{id, displayname}')
            ->getQuery();

        return $query->getArrayResult();
    }
}