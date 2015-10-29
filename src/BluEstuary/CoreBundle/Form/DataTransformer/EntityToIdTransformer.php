<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 22/10/15
 * Time: 18:25
 */

namespace BluEstuary\CoreBundle\Form\DataTransformer;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToIdTransformer implements DataTransformerInterface
{

    protected $objectManager;
    protected $class;

    public function __construct(ObjectManager $manager, $class)
    {
        $this->objectManager = $manager;
        $this->class = $class;
    }

    public function transform($entity)
    {
        if(null === $entity || !is_object($entity))
            return '';

        return $entity->getId();
    }

    public function reverseTransform($id)
    {

        if(!$id)
            return null;

        $entity = $this->objectManager
            ->getRepository($this->class)
            ->findOneBy(array(
                'id' => $id
            ));

        if(null === $entity)
            throw new TransformationFailedException();

        return $entity;
    }
}