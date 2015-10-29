<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 16:26
 */

namespace BluEstuary\PostBundle\Service;


use BluEstuary\CoreBundle\Model\CRUD;
use BluEstuary\PostBundle\Model\CategoryInterface;
use Doctrine\ORM\EntityManager;

class CategoryManager
{
    protected $em;
    protected $categoryClass;

    public function __construct(EntityManager $em, $categoryClass = null)
    {
        $this->em = $em;
        $this->categoryClass = $categoryClass;
    }

    public function generateSuccessMessage(CategoryInterface $category = null, $actionType = "")
    {
        $successMessage = "";

        switch($actionType)
        {
            case CRUD::CREATE:
                $successMessage = "Catégorie créée.";
                break;
            case CRUD::UPDATE:
                $successMessage = "Catégorie mise à jour.";
                break;
            case CRUD::DELETE:
                $successMessage = "Catégorie supprimée.";
        }

        return $successMessage;
    }

    public function loadAllCategories(array $options = array())
    {
        $builder = $this->em->createQueryBuilder();

        $categories = $builder
                        ->select('c')
                        ->from($this->categoryClass, 'c')
                        ->orderBy('c.root, c.lft', 'ASC')
                        ->getQuery()
                        ->getResult();

        return $categories;
    }

    public function anythingBut($id)
    {
        $builder = $this->em->createQueryBuilder();

        $q = $builder
            ->select('c.name')
            ->from($this->categoryClass, 'c');

        if($id !== 0)
            $q = $q->where('c.id != :id')->setParameter('id', $id);

        $categories = $q->getQuery()->getResult();

        return $categories;
    }

    public function loadOrCreateCategory($name)
    {
        $categories = $this->loadOrCreateCategories(array($name));
        return $categories[0];
    }

    public function loadOrCreateCategories(array $names)
    {
        if(empty($names))
            return array();

        $names = array_unique($names);

        $builder = $this->em->createQueryBuilder();

        $categories = $builder
                ->select('c')
                ->from($this->categoryClass, 'c')
                ->where($builder->expr()->in('c.name', $names))
                ->getQuery()
                ->getResult();

        $loadedNames = array();
        foreach($categories as $category)
            $loadedNames[] = $category->getName();

        $missingNames = array_udiff($names, $loadedNames, 'strcasecmp');
        if(sizeof($missingNames)){
            foreach($missingNames as $name){
                $category = $this->createCategory($name);
                $this->em->persist($category);

                $categories[] = $category;
            }

            $this->em->flush();
        }

        return $categories;
    }

    protected function createCategory($name)
    {
        return new $this->categoryClass($name);
    }
}