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

}