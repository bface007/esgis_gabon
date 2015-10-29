<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/09/15
 * Time: 02:54
 */

namespace ESGISGabon\PostBundle\Entity;


use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository
{
    public function anythingBut($id)
    {
        $builder = $this->createQueryBuilder('c')->orderBy('c.root, c.lft', 'ASC');

        if($id !== 0)
            $builder = $builder->where('c.id != :id')->setParameter('id', $id);

        return $builder;
    }
}