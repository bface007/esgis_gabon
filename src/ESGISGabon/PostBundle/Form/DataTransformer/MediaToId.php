<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 25/10/15
 * Time: 01:30
 */

namespace ESGISGabon\PostBundle\Form\DataTransformer;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MediaToId implements DataTransformerInterface
{
    protected $entityManager;
    protected $class;

    public function __construct(ObjectManager $manager, $class)
    {
        $this->entityManager = $manager;
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

        $entity = $this->entityManager
            ->getRepository('ESGISGabonMediaBundle:Media')
            ->find($id);

        if(null === $entity)
            throw new TransformationFailedException(sprintf(
                'An media with number "%s" does not exist',
                $id
            ));

        return $entity;
    }
}